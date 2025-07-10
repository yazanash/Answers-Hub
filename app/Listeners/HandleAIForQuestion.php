<?php

namespace App\Listeners;

use App\Events\QuestionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Notifications\CommentAdded;
use Illuminate\Support\Facades\Http;
class HandleAIForQuestion
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
    public function handle(QuestionCreated $event): void
    {
        $question = $event->question;

        // تجاهل الأسئلة القصيرة
        if (strlen($question->content) < 10) return;

        // جلب البوت
        $bot = User::where('email', 'yazan.ash.doonaas@gmail.com')->first();
        if (!$bot) return;

        // إرسال للذكاء الاصطناعي
        $answer = $this->getCohereAIResponse($question->title, $question->content);

        // إنشاء جواب باسم البوت
        $question->answers()->create([
            'user_id' => $bot->id,
            'content' => $answer,
        ]);
        $question->user->notify(new CommentAdded(
                     'Add answers on your Question',
                    route('questions.show', $question->id),
                    $bot->profile->name
                ));
        // إشعار لصاحب السؤال
        // $question->user->notify(new NewAIResponseNotification($question));
    }
    private function getOpenAIAnswer(string $title, string $body): string
    {
        $prompt = "You are an expert answering questions. Please provide a helpful and accurate answer to the following question:\n\nTitle: $title\n\nBody: $body";

        $res = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
        ]);
        \Log::info('OpenAI response:', $res->json());
        return $res->json('choices.0.message.content') ?? 'Thanks for your question!';
    }
    private function getDeepAIResponseFromDeepAI(string $title, string $body): string
    {
        $text = "Title: $title\n\nBody: $body";

        $response = Http::withHeaders([
            'Api-Key' => env('DEEPAI_API_KEY'),
        ])->post('https://api.deepai.org/api/text-generator', [
            'text' => $text,
        ]);
            \Log::info('Deep Ai response:', $response->json());
        return $response->json('output') ?? 'Thanks for your input!';
    }
    private function getCohereAIResponse(string $title, string $body): string
{
    $prompt ="You are an expert assistant answering the following question. Please respond in **Markdown** format with clear and helpful information.

Question Title: $title

Question Body: $body

Write your answer below:";
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
