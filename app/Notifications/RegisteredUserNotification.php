<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredUserNotification extends Notification
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
                    ->subject('sucessfully registeration!')
                    ->greeting('Hello ' . $this->user->name . '!')
                    ->line('Please verify your account using this OTP: '. $this->user->otp )
                    ->line('Thank you for registering .')
                    ->line('We are excited to have you on board with us. Please verify your email to activate your account.');
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
            'message' => 'Welcome, ' . $notifiable->name . '! Your account is now created and need to be verified.',
        ];
    }
}
