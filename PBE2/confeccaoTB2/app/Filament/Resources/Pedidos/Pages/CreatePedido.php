<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\User;
use App\Notifications\NovoPedidoNotification;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected function afterCreate(): void
    {
        $pedido = $this->record;
        $total = $pedido->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        $pedido->update(['valor_total' => $total]);

        $pedido->refresh()->loadMissing(['cliente', 'itens.produto']);

        User::role('Logistica')
            ->get()
            ->each(fn (User $usuario) => $usuario->notify(new NovoPedidoNotification($pedido)));

        Notification::make()
            ->title('Pedido criado!')
            ->body("Pedido #{$pedido->id} criado. Equipe de logística notificada.")
            ->success()
            ->send();
    }
}
