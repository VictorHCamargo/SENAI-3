<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Gerenciamento de Pedidos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Ref.</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Cliente</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Descrição</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Entrega</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pedidos as $pedido)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                                        {{ $pedido->numero_pedido }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">
                                        {{ $pedido->cliente->nome }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ Str::limit($pedido->descricao_itens, 30) }}
                                    </td>
                                    <td class="px-6 py-4 text-xs">
                                        @php
                                            $cores = [
                                                'pendente' => 'bg-yellow-100 text-yellow-700',
                                                'em_producao' => 'bg-blue-100 text-blue-700',
                                                'finalizado' => 'bg-purple-100 text-purple-700',
                                                'entregue' => 'bg-green-100 text-green-700',
                                                'cancelado' => 'bg-red-100 text-red-700',
                                            ];
                                            $cor = $cores[$pedido->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2 py-1 rounded-full font-semibold {{ $cor }}">
                                            {{ strtoupper(str_replace('_', ' ', $pedido->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">
                                        {{ $pedido->data_entrega_prevista ? \Carbon\Carbon::parse($pedido->data_entrega_prevista)->format('d/m/Y') : '--' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-900 text-right">
                                        R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-gray-400">
                                            <p class="text-lg">Nenhum pedido encontrado.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>