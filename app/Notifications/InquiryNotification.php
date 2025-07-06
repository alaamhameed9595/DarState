<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryNotification  extends Notification
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Property Inquiry - DarState')
            ->greeting('Hello!')
            ->line('You have received a new inquiry for property: ' . $this->data['title'])
            ->line('Name: ' . $this->data['name'])
            ->line('Phone: ' . $this->data['phone'])
            ->line('Email: ' . $this->data['email'])
            ->line('Message: ' . $this->data['message'])
            ->action('View Property', route('auth.properties.show', $this->data['property_id']))
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
            'type' => 'property_inquiry',
            'title' => 'New Property Inquiry',
            'message' => 'New inquiry for property: ' . $this->data['title'],
            'property_id' => $this->data['property_id'],
            'data' => $this->data,
        ];
    }
}
