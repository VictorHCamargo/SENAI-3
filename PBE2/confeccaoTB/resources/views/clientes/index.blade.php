<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Lista de Clientes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">ID</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Nome</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">CPF</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-right">Telefone</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($clientes as $cliente)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-400">#{{ $cliente->id }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $cliente->nome }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $cliente->cpf }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-right font-mono">{{ $cliente->telefone }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="text-gray-400">
                                            <p class="text-lg">Nenhum cliente cadastrado.</p>
                                            <p class="text-sm">Os novos registros aparecerão aqui.</p>
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