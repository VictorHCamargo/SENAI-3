<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">Cadastrar Novo Produto</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('produtos.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            
                            <div>
                                <label for="nome" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Nome do Produto</label>
                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="sku" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">SKU / Código</label>
                                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm font-mono">
                                </div>
                                <div>
                                    <label for="preco_venda" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Preço de Venda (R$)</label>
                                    <input type="number" step="0.01" name="preco_venda" id="preco_venda" value="{{ old('preco_venda') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="tamanho" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Tamanho</label>
                                    <input type="text" name="tamanho" id="tamanho" value="{{ old('tamanho') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="cor" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Cor</label>
                                    <input type="text" name="cor" id="cor" value="{{ old('cor') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="tecido" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Tecido</label>
                                    <input type="text" name="tecido" id="tecido" value="{{ old('tecido') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label for="descricao" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Descrição</label>
                                <textarea name="descricao" id="descricao" rows="3" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">{{ old('descricao') }}</textarea>
                            </div>

                            <div>
                                <label for="ativo" class="flex items-center">
                                    <input type="hidden" name="ativo" value="0">
                                    <input type="checkbox" name="ativo" id="ativo" value="1" {{ old('ativo', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">Produto Ativo (Visível no catálogo)</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('produtos') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Salvar Produto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>