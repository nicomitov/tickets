<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        // dd($notifiable->routes);
        // dd(array_key_exists('mail', $notifiable->routes));
        // return ['mail'];
        // return ['mail', 'database'];

        if (!is_null($notifiable->routes) && array_key_exists('mail', $notifiable->routes)) {
            return ['mail'];
        } else {
            return ['database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('tickets.show', $this->ticket);
        $author = auth()->user()->name;
        $subject = $this->ticket->name;
        $date = $this->ticket->updated_at;
        $this->ticket->created_at == $this->ticket->updated_at ? $action = 'created' : $action = 'updated';
        $this->ticket->created_at == $this->ticket->updated_at ? $subj_action = 'New Ticket' : $subj_action = 'Updated Ticket';

        return (new MailMessage)
            ->subject($subj_action)
            ->markdown('mail.ticket', [
                'entry_type' => 'ticket',
                'action' => $action,
                'url' => $url,
                'author' => $author,
                'subject' => $subject,
                'date' => $date,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = route('tickets.show', $this->ticket);
        $author = auth()->user()->name;
        $image = auth()->user()->getAvatarThumb();
        $subject = $this->ticket->name;
        $date = \Carbon\Carbon::parse($this->ticket->updated_at)->format('Y-m-d H:i');
        $this->ticket->created_at == $this->ticket->updated_at ? $action = 'created a new ' : $action = 'updated a ';

        return [
            'url' => $url,
            'author' => $author,
            'image' => $image,
            'action' => $action . 'ticket',
            'subject' => $subject,
            'date' => $date,
        ];
    }
}
