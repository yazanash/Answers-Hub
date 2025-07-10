<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\CommentAdded;

class HandlePostWithAI implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $post = $this->post;

        // لو البوست قصير، تجاهله
        if (strlen($post->content) < 30) return;

        // جلب مستخدم البوت
        $bot = User::where('email', 'bot@answers-hub.com')->first();
        if (!$bot) return;

        // إرسال للذكاء الاصطناعي
        $response = $this->getCohereAIResponse($post->title, $post->content);

        // إنشاء تعليق باسم البوت
        $post->comments()->create([
            'user_id' => $bot->id,
            'content' => $response,
        ]);
        $post->user->notify(new CommentAdded(
                     'Add comment on your Article',
                    route('posts.show', $post->id),
                    $bot->profile->name
                ));
    }
    private function getCohereAIResponse(string $title, string $body): string
{
    $prompt = "You're an AI assistant replying to a post. Please respond in **Markdown** format. 

Here is the post:

Title: $title

Body: $body

Write a helpful comment or answer with basic formatting (bold, italic, bullet points, etc).";;

    $res = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://api.cohere.ai/v1/chat', [
        'model' => 'command-r', // مجاني
        'message' => $prompt,
    ]);
 \Log::info('COHERE AI response:', $res->json());
    return $res->json('text') ?? 'Thanks for your input!';
}
}
