<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentCompletedEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $paid_user)
    {
        $this->data = $data;
        $this->paid_user = $paid_user;
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
     */
    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }

    public function getMessage()
    {
        return (new MailMessage)
                ->subject('IELTS Booking' . ': Payment Successful ' )
                ->greeting('Hi,')
                ->line('We would like to inform you that your payment is successful for ' . $this->paid_user->bookDatePayment->date->available_date . '.')
                ->line('Your booking code is ' . Session::get('permanent_booking_code') . '.')
                ->line('Thank you,')
                ->line('Technorio Team')
                ->salutation(' ');
    }
}
