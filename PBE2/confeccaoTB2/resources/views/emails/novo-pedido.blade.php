<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Novo Pedido</title>
</head>
<body style="margin: 0; padding: 0; background: #f8fafc; color: #1f2937; font-family: Arial, sans-serif;">
    <div style="max-width: 720px; margin: 0 auto; padding: 32px 20px;">
        <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
            <div style="background: #f59e0b; color: #111827; padding: 20px 24px;">
                <h1 style="margin: 0; font-size: 22px;">Novo Pedido #{{ $pedido->id }}</h1>
                <p style="margin: 6px 0 0;">A equipe de logística recebeu um novo pedido.</p>
            </div>

            <div style="padding: 24px;">
                <p><strong>Cliente:</strong> {{ $pedido->cliente?->nome ?? 'Cliente não informado' }}</p>
                <p><strong>Status:</strong> {{ $pedido->status }}</p>
                <p><strong>Valor total:</strong> R$ {{ number_format((float) $pedido->valor_total, 2, ',', '.') }}</p>
                <p><strong>Data do pedido:</strong> {{ $pedido->created_at?->format('d/m/Y H:i') }}</p>

                <h2 style="font-size: 18px; margin: 24px 0 12px;">Itens do pedido</h2>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 10px; border-bottom: 1px solid #e5e7eb;">Produto</th>
                            <th style="text-align: right; padding: 10px; border-bottom: 1px solid #e5e7eb;">Quantidade</th>
                            <th style="text-align: right; padding: 10px; border-bottom: 1px solid #e5e7eb;">Preço unitário</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedido->itens as $item)
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #f1f5f9;">{{ $item->produto?->nome ?? 'Produto não informado' }}</td>
                                <td style="text-align: right; padding: 10px; border-bottom: 1px solid #f1f5f9;">{{ $item->quantidade }}</td>
                                <td style="text-align: right; padding: 10px; border-bottom: 1px solid #f1f5f9;">R$ {{ number_format((float) $item->preco_unitario, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="padding: 10px; border-bottom: 1px solid #f1f5f9;">Nenhum item informado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="padding: 16px 24px; background: #f8fafc; color: #64748b; font-size: 13px;">
                Confecção TB2
            </div>
        </div>
    </div>
</body>
</html>
