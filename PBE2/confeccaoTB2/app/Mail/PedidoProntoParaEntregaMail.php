<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoProntoParaEntregaMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Pedido $pedido)
    {
        $this->pedido->loadMissing(['cliente', 'itens.produto']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Pedido #{$this->pedido->id} pronto para entrega - {$this->pedido->cliente?->nome}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido-pronto-entrega',
            with: [
                'pedido' => $this->pedido,
            ],
        );
    }
}
