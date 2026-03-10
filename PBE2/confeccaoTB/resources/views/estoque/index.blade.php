<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestão de Estoque</h2>
            <a href="{{ route('estoque.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg> Novo Estoque
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success')) 
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 rounded-r-lg shadow-sm flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            @endif
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