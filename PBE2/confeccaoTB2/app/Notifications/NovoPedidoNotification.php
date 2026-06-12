<?php

namespace App\Notifications;

use App\Mail\NovoPedidoMail;
use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class NovoPedidoNotification extends Notification
{
    use Queueable;

    public function __construct(public Pedido $pedido)
    {
        //
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): Mailable
    {
        return (new NovoPedidoMail($this->pedido))
            ->to($notifiable->routeNotificationFor('mail', $this) ?? $notifiable->email);
    }
}
