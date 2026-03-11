<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editar Item de Estoque: {{ $estoque->item }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('estoque.update', $estoque->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            {{-- Nome do Item --}}
                            <div>
                                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Nome do Item/Insumo</label>
                                <input type="text" name="item" value="{{ old('item', $estoque->item) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                @error('item') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            {{-- Vínculos --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Produto Vinculado (Opcional)</label>
                                    <select name="produto_id" class="w-full border-gray-200 rounded-lg shadow-sm">
                                        <option value="">Nenhum produto</option>
                                        @foreach($produtos as $prod)
                                            <option value="{{ $prod->id }}" {{ old('produto_id', $estoque->produto_id) == $prod->id ? 'selected' : '' }}>
                                                {{ $prod->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Fornecedor (Opcional)</label>
                                    <select name="fornecedor_id" class="w-full border-gray-200 rounded-lg shadow-sm">
                                        <option value="">Nenhum fornecedor</option>
                                        @foreach($fornecedores as $forn)
                                            <option value="{{ $forn->id }}" {{ old('fornecedor_id', $estoque->fornecedor_id) == $forn->id ? 'selected' : '' }}>
                                                {{ $forn->nome_fantasia }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Quantidades e Valores --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Qtd Atual</label>
                                    <input type="number" step="0.01" name="quantidade_atual" value="{{ old('quantidade_atual', $estoque->quantidade_atual) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Qtd Mínima</label>
                                    <input type="number" step="0.01" name="quantidade_minima" value="{{ old('quantidade_minima', $estoque->quantidade_minima) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Unid. Medida</label>
                                    <input type="text" name="unidade_medida" value="{{ old('unidade_medida', $estoque->unidade_medida) }}" placeholder="Ex: kg, m, un" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Valor Unitário (R$)</label>
                                    <input type="number" step="0.01" name="valor_unitario" value="{{ old('valor_unitario', $estoque->valor_unitario) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Localização no Estoque</label>
                                    <input type="text" name="localizacao" value="{{ old('localizacao', $estoque->localizacao) }}" placeholder="Ex: Prateleira A2" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('estoque') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Atualizar Estoque</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>