<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerificationCode extends Notification
{
    use Queueable;

    protected int $code;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // Generate and persist the code on the user
        $this->code = rand(1000, 9999);
        $notifiable->update([
            'verification_code' => $this->code,
            'code_expires_at'   => now()->addMinutes(15),
        ]);

        return (new MailMessage)
            ->subject('WBHub Email Verification Code')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Your 4‑digit verification code is:')
            ->line("<strong style=\"font-size:2rem;\">{$this->code}</strong>")
            ->line('This code will expire in 15 minutes.')
            ->salutation('Thank you for joining WBHub!');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}