<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Cadastrar Novo Pedido
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('pedidos.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            
                            <div>
                                <label for="cliente_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Cliente</label>
                                <select name="cliente_id" id="cliente_id" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                    <option value="">Selecione um cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="numero_pedido" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Nº do Pedido</label>
                                    <input type="text" name="numero_pedido" id="numero_pedido" value="{{ old('numero_pedido') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm font-mono">
                                    @error('numero_pedido') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Status</label>
                                    <select name="status" id="status" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                        <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                        <option value="em_producao" {{ old('status') == 'em_producao' ? 'selected' : '' }}>Em Produção</option>
                                        <option value="finalizado" {{ old('status') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                        <option value="entregue" {{ old('status') == 'entregue' ? 'selected' : '' }}>Entregue</option>
                                    </select>
                                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="data_entrega_prevista" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Previsão de Entrega</label>
                                    <input type="date" name="data_entrega_prevista" id="data_entrega_prevista" value="{{ old('data_entrega_prevista') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="data_entrega_realizada" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Entrega Realizada</label>
                                    <input type="date" name="data_entrega_realizada" id="data_entrega_realizada" value="{{ old('data_entrega_realizada') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="valor_total" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Valor Total (R$)</label>
                                    <input type="number" step="0.01" name="valor_total" id="valor_total" value="{{ old('valor_total') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="entrada" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Entrada / Adiantamento (R$)</label>
                                    <input type="number" step="0.01" name="entrada" id="entrada" value="{{ old('entrada') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label for="descricao_itens" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Descrição dos Itens</label>
                                <textarea name="descricao_itens" id="descricao_itens" rows="3" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">{{ old('descricao_itens') }}</textarea>
                            </div>

                            <div>
                                <label for="observacoes" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Observações</label>
                                <textarea name="observacoes" id="observacoes" rows="2" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">{{ old('observacoes') }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('pedidos') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4 transition-colors">Cancelar</a>
                                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-md text-sm">Salvar Pedido</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>