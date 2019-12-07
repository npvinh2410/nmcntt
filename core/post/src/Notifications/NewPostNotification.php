<?php

namespace Hydrogen\Post\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPostNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $postNotification;


    public function __construct($postNotification)
    {
        $this->postNotification = $postNotification;
    }


    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    public function toMail($notifiable)
    {
        $url = route('posts.show', ['id' => $this->postNotification->id,
            'lang_code' => $this->postNotification->lang_code]);

        return (new MailMessage)->view(
            'dashboard::email.new_p', [
                'p_type' => 'post',
                'p_url' => $url
            ]
        );
    }

    public function toDatabase($notifiable)
    {
        return [
            'href' => route('posts.show', ['id' => $this->postNotification->id,
                'lang_code' => $this->postNotification->lang_code]),
            'value' => 'Bài viết '.$this->postNotification->title.' mới được tạo.',
        ];
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }


}
