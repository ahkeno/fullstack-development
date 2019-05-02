<?php

namespace App\Notifications;
use App\Model\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function index() {
        return [
        'read' => auth()->user()->readNotifications()->get(),
        'unread' => auth()->user()->unreadNotifications()->get(),
        ];
        }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'repliedBy' => $this->reply->user->name,
            'question' => $this->reply->question->title,
            'path' => $this->reply->question->path,
            'reply' => $this->reply,
        ];
    }
}
