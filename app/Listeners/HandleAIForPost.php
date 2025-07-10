<?php

namespace App\Listeners;
use App\Jobs\HandlePostWithAI;
use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentAdded;
use Illuminate\Support\Facades\Http;
class HandleAIForPost
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        HandlePostWithAI::dispatch($event->post);
        //  $post = $event->post;

        // // لو البوست قصير، تجاهله
        // if (strlen($post->content) < 30) return;

        // // جلب مستخدم البوت
        // $bot = User::where('email', 'yazan.ash.doonaas@gmail.com')->first();
        // if (!$bot) return;

        // // إرسال للذكاء الاصطناعي
        // $response = $this->getDeepAIResponseFromDeepAI($post->title, $post->content);

        // // إنشاء تعليق باسم البوت
        // $post->comments()->create([
        //     'user_id' => $bot->id,
        //     'content' => $response,
        // ]);
        // $post->user->notify(new CommentAdded(
        //              'Add comment on your Article',
        //             route('posts.show', $post->id),
        //             $bot->profile->name
        //         ));
        // إشعار لصاحب المقال
        // $post->user->notify(new NewAIResponseNotification($post));
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
