<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Gestão de Insumos e Estoque
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Item / Localização</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-center">Qtd. Atual</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-center">Unidade</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Valor Unit.</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($estoque as $itens)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="font-bold text-gray-800">{{ $itens->item }}</div>
                                        <div class="text-xs text-blue-500 font-mono">{{ $itens->localizacao }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <span class="font-bold {{ $itens->quantidade_atual <= $itens->quantidade_minima ? 'text-red-500' : 'text-gray-800' }}">
                                            {{ $itens->quantidade_atual }}
                                        </span>
                                        @if($itens->quantidade_atual <= $itens->quantidade_minima)
                                            <span class="block text-[10px] text-red-400 uppercase font-bold">Repor!</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-center italic">
                                        {{ $itens->unidade_medida }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-right">
                                        R$ {{ number_format($itens->valor_unitario, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 text-right font-bold">
                                        R$ {{ number_format($itens->quantidade_atual * $itens->valor_unitario, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <p class="text-lg">O estoque está vazio.</p>
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