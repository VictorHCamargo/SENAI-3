<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">Adicionar Estoque</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('estoque.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            
                            <div>
                                <label for="item" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Nome do Estoque</label>
                                <input type="text" name="item" id="item" value="{{ old('item') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="fornecedor_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Vincular a Produto (Opcional)</label>
                                    <select name="produto_id" id="produto_id" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                        <option value="">Nenhum</option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>{{ $produto->nome }}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <div>
                                    <label for="fornecedor_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Fornecedor (Opcional)</label>
                                    <select name="fornecedor_id" id="fornecedor_id" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                        <option value="">Nenhum</option>
                                        @foreach($fornecedores as $fornecedor)
                                            <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>{{ $fornecedor->nome_fantasia }}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="quantidade_atual" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Qtd. Atual</label>
                                    <input type="number" step="0.01" name="quantidade_atual" id="quantidade_atual" value="{{ old('quantidade_atual') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="quantidade_minima" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Qtd. Mínima</label>
                                    <input type="number" step="0.01" name="quantidade_minima" id="quantidade_minima" value="{{ old('quantidade_minima') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="unidade_medida" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Unidade</label>
                                    <select name="unidade_medida" id="unidade_medida" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                        <option value="Unidade">Unidade (un)</option>
                                        <option value="Metros">Metros (m)</option>
                                        <option value="Rolos">Rolos</option>
                                        <option value="Kg">Quilogramas (kg)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="valor_unitario" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Valor Unitário (R$)</label>
                                    <input type="number" step="0.01" name="valor_unitario" id="valor_unitario" value="{{ old('valor_unitario') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="localizacao" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Localização (Prateleira/Estoque)</label>
                                    <input type="text" name="localizacao" id="localizacao" value="{{ old('localizacao') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('estoque') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Salvar Insumo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>