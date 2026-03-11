<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editar Pedido: {{ $pedido->numero_pedido }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Cliente</label>
                                    <select name="cliente_id" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                        <option value="">Selecione um cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Nº do Pedido</label>
                                    <input type="text" name="numero_pedido" value="{{ old('numero_pedido', $pedido->numero_pedido) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                    @error('numero_pedido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Status</label>
                                    <input type="text" name="status" value="{{ old('status', $pedido->status) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Entrega Prevista</label>
                                    <input type="date" name="data_entrega_prevista" value="{{ old('data_entrega_prevista', $pedido->data_entrega_prevista) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Entrega Realizada</label>
                                    <input type="date" name="data_entrega_realizada" value="{{ old('data_entrega_realizada', $pedido->data_entrega_realizada) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Valor Total</label>
                                    <input type="number" step="0.01" name="valor_total" value="{{ old('valor_total', $pedido->valor_total) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Entrada</label>
                                    <input type="number" step="0.01" name="entrada" value="{{ old('entrada', $pedido->entrada) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Descrição dos Itens</label>
                                <textarea name="descricao_itens" rows="2" required class="w-full border-gray-200 rounded-lg shadow-sm">{{ old('descricao_itens', $pedido->descricao_itens) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Observações</label>
                                <textarea name="observacoes" rows="2" class="w-full border-gray-200 rounded-lg shadow-sm">{{ old('observacoes', $pedido->observacoes) }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('pedidos') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Atualizar Pedido</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>