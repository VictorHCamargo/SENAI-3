<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editar Produto: {{ $produto->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            {{-- Nome e SKU --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Nome do Produto</label>
                                    <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                    @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">SKU (Código)</label>
                                    <input type="text" name="sku" value="{{ old('sku', $produto->sku) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                    @error('sku') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Preço, Tamanho, Cor e Tecido --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Preço de Venda (R$)</label>
                                    <input type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $produto->preco_venda) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Tamanho</label>
                                    <input type="text" name="tamanho" value="{{ old('tamanho', $produto->tamanho) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Cor</label>
                                    <input type="text" name="cor" value="{{ old('cor', $produto->cor) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Tecido</label>
                                    <input type="text" name="tecido" value="{{ old('tecido', $produto->tecido) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            {{-- Descrição --}}
                            <div>
                                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Descrição do Produto</label>
                                <textarea name="descricao" rows="3" class="w-full border-gray-200 rounded-lg shadow-sm">{{ old('descricao', $produto->descricao) }}</textarea>
                            </div>

                            {{-- Status Ativo (Checkbox) --}}
                            <div class="flex items-center mt-2">
                                {{-- Input hidden para garantir que envie 0 se não estiver marcado --}}
                                <input type="hidden" name="ativo" value="0">
                                <input type="checkbox" name="ativo" id="ativo" value="1" {{ old('ativo', $produto->ativo) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="ativo" class="ml-2 text-sm text-gray-600 font-medium">Produto Ativo (Visível no catálogo)</label>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('produtos') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Atualizar Produto</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>