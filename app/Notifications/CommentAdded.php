<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public string $message;
    public string $url;
    public string $commenterName;
    public function __construct(string $message, string $url, string $commenterName)
    {
         $this->message = $message;
        $this->url = $url;
        $this->commenterName = $commenterName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
              'commenter' => $this->commenterName,
            'url' => $this->url,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'commenter' => $this->commenterName,
        'message' => $this->message,
        'url' => $this->url,
    ]);
}
}
