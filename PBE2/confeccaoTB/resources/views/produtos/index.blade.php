<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Catálogo de Produtos (Confecção)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">SKU / ID</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Produto</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Atributos</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Preço Venda</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($produtos as $produto)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-400">
                                        <span class="block text-gray-800 font-mono">{{ $produto->sku }}</span>
                                        <span class="text-xs">#{{ $produto->id }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="font-bold text-gray-800">{{ $produto->nome }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($produto->descricao, 40) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                                            {{ $produto->tamanho }}
                                        </span>
                                        <span class="text-xs italic">{{ $produto->cor }}</span> • 
                                        <span class="text-xs">{{ $produto->tecido }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 text-right font-bold">
                                        R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="text-gray-400">
                                            <p class="text-lg">Nenhum produto em linha.</p>
                                            <p class="text-sm">Cadastre suas peças para vê-las aqui.</p>
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