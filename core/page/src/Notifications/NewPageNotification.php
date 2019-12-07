<?php

namespace Hydrogen\Page\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPageNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $pageNotification;


    public function __construct($pageNotification)
    {
        $this->pageNotification = $pageNotification;
    }


    public function via($notifiable)
    {
        return ['database', 'mail'];
    }


    public function toMail($notifiable)
    {
        $url = route('pages.show', ['id' => $this->pageNotification->id,
            'lang_code' => $this->pageNotification->lang_code]);

        return (new MailMessage)->view(
            'dashboard::email.new_p', [
                'p_type' => 'trang',
                'p_url' => $url
            ]
        );
    }

    public function toDatabase($notifiable)
    {
        return [
            'href' => route('pages.show', ['id' => $this->pageNotification->id,
                'lang_code' => $this->pageNotification->lang_code]),
            'value' => 'Trang '.$this->pageNotification->title.' mới được tạo',
        ];
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }


}
