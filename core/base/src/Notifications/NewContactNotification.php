<?php

namespace Hydrogen\Base\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contactNotification;


    public function __construct($contactNotification)
    {
        $this->contactNotification = $contactNotification;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    public function toMail($notifiable)
    {
        $url = route('contacts.show', ['id' => $this->contactNotification->id]);

        return (new MailMessage)->view(
            'dashboard::email.new_p', [
                'p_url' => $url
            ]
        );
    }

    public function toDatabase($notifiable)
    {
        return [
            'href' => route('contacts.show', ['id' => $this->contactNotification->id]),
            'value' => 'Contact '.$this->contactNotification->title.' mới được gửi tới',
        ];
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }


}
