<?php

namespace App\Listeners;

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
         $post = $event->post;

        // لو البوست قصير، تجاهله
        if (strlen($post->content) < 30) return;

        // جلب مستخدم البوت
        $bot = User::where('email', 'yazan.ash.doonaas@gmail.com')->first();
        if (!$bot) return;

        // إرسال للذكاء الاصطناعي
        $response = $this->getDeepAIResponseFromDeepAI($post->title, $post->content);

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
        // إشعار لصاحب المقال
        // $post->user->notify(new NewAIResponseNotification($post));
    }
    private function getOpenAIResponse(string $title, string $body): string
    {
        $prompt = "Please provide a brief review or feedback on the following article:\n\nTitle: $title\n\nBody: $body";

        $res = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
        ]);

        return $res->json('choices.0.message.content') ?? 'Thanks for your post!';
    }
     private function getDeepAIResponseFromDeepAI(string $title, string $body): string
    {
        $text = "Title: $title\n\nBody: $body";

        $response = Http::withHeaders([
            'Api-Key' => env('DEEPAI_API_KEY'),
        ])->post('https://api.deepai.org/api/text-generator', [
            'text' => $text,
        ]);
         \Log::info('OpenAI response:', $response->json());
        return $response->json('output') ?? 'Thanks for your input!';
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
