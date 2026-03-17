<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel Geral da Confecção') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="text-gray-500 text-sm">Novos Clientes (30 dias)</div>
                        <div class="text-3xl font-bold text-blue-600">
                            {{ $clientesUltimoMes }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="text-gray-500 text-sm">Receita (Este Mês)</div>
                        <div class="text-3xl font-bold text-green-600">
                            R$ {{ number_format($receitaMes, 2, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="text-gray-500 text-sm">Receita Total Acumulada</div>
                        <div class="text-3xl font-bold text-indigo-600">
                            R$ {{ number_format($receitaTotal, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-b border-gray-200">
                        <h3 class="font-semibold text-lg mb-4 text-red-600">⚠️ Alerta de Estoque Baixo</h3>
                        
                        @if($estoqueBaixo->count() > 0)
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="border-b py-2 text-sm text-gray-600">Item</th>
                                        <th class="border-b py-2 text-sm text-gray-600">Atual</th>
                                        <th class="border-b py-2 text-sm text-gray-600">Mínima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estoqueBaixo as $item)
                                        <tr>
                                            <td class="py-2 border-b text-sm font-medium">{{ $item->item }}</td>
                                            <td class="py-2 border-b text-sm text-red-500 font-bold">{{ $item->quantidade_atual }} {{ $item->unidade_medida }}</td>
                                            <td class="py-2 border-b text-sm text-gray-500">{{ $item->quantidade_minima }} {{ $item->unidade_medida }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-green-600 text-sm">Estoque saudável. Nenhum item abaixo do limite.</p>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 border-b border-gray-200">
                        <h3 class="font-semibold text-lg mb-4 text-gray-800">🏆 Top 5 Clientes (Por Volume de Pedidos)</h3>
                        
                        @if($topClientes->count() > 0)
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="border-b py-2 text-sm text-gray-600">Cliente</th>
                                        <th class="border-b py-2 text-sm text-gray-600 text-center">Nº de Pedidos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topClientes as $cliente)
                                        <tr>
                                            <td class="py-2 border-b text-sm font-medium">{{ $cliente->nome }}</td>
                                            <td class="py-2 border-b text-sm text-center text-indigo-600 font-bold">{{ $cliente->pedidos_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 text-sm">Nenhum pedido registrado ainda.</p>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>