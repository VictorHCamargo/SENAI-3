<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Nossos Fornecedores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Fornecedor</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Categoria</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">CNPJ</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Contato</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($fornecedores as $fornecedor)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-800">{{ $fornecedor->nome_fantasia }}</div>
                                        <div class="text-xs text-gray-400">{{ $fornecedor->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-600 rounded">
                                            {{ $fornecedor->categoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $fornecedor->cnpj }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-right">{{ $fornecedor->telefone }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <p class="text-gray-400 text-lg">Nenhum fornecedor encontrado.</p>
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