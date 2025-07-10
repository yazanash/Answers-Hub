<?php

namespace App\Listeners;
use App\Jobs\HandleQuestionWithAI;
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
        HandleQuestionWithAI::dispatch($event->question);
        // $question = $event->question;

        // // تجاهل الأسئلة القصيرة
        // if (strlen($question->content) < 10) return;

        // // جلب البوت
        // $bot = User::where('email', 'yazan.ash.doonaas@gmail.com')->first();
        // if (!$bot) return;

        // // إرسال للذكاء الاصطناعي
        // $answer = $this->getCohereAIResponse($question->title, $question->content);

        // // إنشاء جواب باسم البوت
        // $question->answers()->create([
        //     'user_id' => $bot->id,
        //     'content' => $answer,
        // ]);
        // $question->user->notify(new CommentAdded(
        //              'Add answers on your Question',
        //             route('questions.show', $question->id),
        //             $bot->profile->name
        //         ));
        // إشعار لصاحب السؤال
        // $question->user->notify(new NewAIResponseNotification($question));
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
