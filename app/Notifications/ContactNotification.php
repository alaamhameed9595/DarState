<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Form Submission - DarState')
            ->greeting('Hello!')
            ->line('You have received a new contact form submission:')
            ->line('Name: ' . $this->data['text'])
            ->line('Phone: ' . $this->data['number'])
            ->line('Email: ' . $this->data['email'])
            ->line('Message: ' . $this->data['message'])
            ->salutation('Best regards,')
            ->line('The DarState Team')
            ->line('Your trusted real estate partner');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'contact_form',
            'title' => 'New Contact Form Submission',
            'message' => 'You have received a new contact form submission from ' . $this->data['text'],
            'data' => $this->data,
        ];
    }
}
