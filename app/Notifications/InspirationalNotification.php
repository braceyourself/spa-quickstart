<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Inspiring;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InspirationalNotification extends Notification
{
    use Queueable;
	/**
	 * @var array
	 */
	private $data;

	/**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        //
		$this->data = $data;
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
		$dt = Carbon::now()->toDateTimeString();
        return (new MailMessage)
            ->line("Hello ". $this->data['user']['name'].'!')
			->line(Inspiring::quote())
			->line("Sent at $dt");
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
            //
        ];
    }
}
