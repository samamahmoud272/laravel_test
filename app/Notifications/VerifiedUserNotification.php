<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifiedUserNotification extends Notification
{
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Send notification via email & store in DB
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('sucessfully verification!')
                    ->greeting('Hello ' . $this->user->name . '!')
                    ->line('you are verified sucessfully  .')
                    ->line('We are excited to have you on board with us.');
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
            'message' => 'Welcome, ' . $notifiable->name . '! Your account is now verified.',
        ];
    }
}
