<?php

namespace App\Jobs;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\CommentAdded;
class HandleQuestionWithAI implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $question = $this->question;

        // تجاهل الأسئلة القصيرة
        if (strlen($question->content) < 10) return;

        // جلب البوت
        $bot = User::where('email', 'bot@answers-hub.com')->first();
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
