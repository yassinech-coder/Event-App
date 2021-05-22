<?php

namespace App\Notifications;
use App\Models\Comment;
use App\Models\User;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyAdded extends Notification
{
    use Queueable;

    protected $user;
    protected $comment;
    protected $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment,User $user,Event $event)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->event = $event;
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


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'eventTitle' => $this->event->title,
            'eventId' => $this->event->id,
            'name' => $this->user->name,
        ];
    }
}
