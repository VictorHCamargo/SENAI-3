<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editar Fornecedor: {{ $fornecedor->nome_fantasia }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Nome Fantasia</label>
                                    <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $fornecedor->nome_fantasia) }}" required class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Razão Social</label>
                                    <input type="text" name="razao_social" value="{{ old('razao_social', $fornecedor->razao_social) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">CNPJ</label>
                                    <input type="text" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" class="w-full border-gray-200 rounded-lg shadow-sm" readonly>
                                    @error('cnpj') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Categoria</label>
                                    <input type="text" name="categoria" value="{{ old('categoria', $fornecedor->categoria) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Telefone</label>
                                    <input type="text" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">E-mail</label>
                                    <input type="email" name="email" value="{{ old('email', $fornecedor->email) }}" class="w-full border-gray-200 rounded-lg shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold uppercase text-gray-500 mb-1">Endereço</label>
                                <textarea name="endereco" rows="2" class="w-full border-gray-200 rounded-lg shadow-sm">{{ old('endereco', $fornecedor->endereco) }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('fornecedores') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Atualizar Fornecedor</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>