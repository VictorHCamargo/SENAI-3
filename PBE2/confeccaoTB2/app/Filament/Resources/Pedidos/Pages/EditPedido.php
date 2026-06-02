<?php

namespace App\Filament\Resources\Pedidos\Pages;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\User;
use App\Notifications\PedidoProntoParaEntregaNotification;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $pedido = $this->record;
        $prontoParaEntrega = $pedido->wasChanged('status') && $pedido->status === 'Para Entrega';

        $total = $pedido->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });

        $pedido->update(['valor_total' => $total]);

        if (! $prontoParaEntrega) {
            return;
        }

        $pedido->refresh()->loadMissing(['cliente', 'itens.produto']);

        User::role('Logistica')
            ->get()
            ->each(fn (User $usuario) => $usuario->notify(new PedidoProntoParaEntregaNotification($pedido)));

        Notification::make()
            ->title('Pedido pronto para entrega!')
            ->body("Pedido #{$pedido->id} está pronto para a logística.")
            ->success()
            ->send();
    }
}
