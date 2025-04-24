<?php
// app/Notifications/ConnectionRequestNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ConnectionRequestNotification extends Notification
{
    use Queueable;

    protected $fromUser;
    protected $connectionId;

    public function __construct($fromUser, $connectionId)
    {
        $this->fromUser = $fromUser;
        $this->connectionId = $connectionId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'connection_request',
            'title' => "{$this->fromUser->first_name} {$this->fromUser->last_name} wants to connect.",
            'icon' => 'ri-user-add-line',
            'connection_id' => $this->connectionId, // use directly, don't try to look it up again
            'from_user_id' => $this->fromUser->id,
            'link' => route('profile.show', $this->fromUser->id),
        ];
    }
}