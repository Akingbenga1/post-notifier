<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $website;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, Website $website)
    {
        //
        $this->post = $post;
        $this->website = $website;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New Post published on {$this->website->name}.")
                    ->line("A new Post with title , {$this->post->post_title} was just published on {$this->website->name}. View the post content below.")
                    ->line("{$this->post->post_description}")
                    ->line('Thank you for using the Post Notifier!');
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
            //
        ];
    }
}
