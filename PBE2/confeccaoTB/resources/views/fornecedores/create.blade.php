<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">Cadastrar Novo Fornecedor</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('fornecedores.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nome_fantasia" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Nome Fantasia</label>
                                    <input type="text" name="nome_fantasia" id="nome_fantasia" value="{{ old('nome_fantasia') }}" required class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                                <div>
                                    <label for="razao_social" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Razão Social</label>
                                    <input type="text" name="razao_social" id="razao_social" value="{{ old('razao_social') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="cnpj" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">CNPJ</label>
                                    <input type="text" name="cnpj" id="cnpj" value="{{ old('cnpj') }}" placeholder="00.000.000/0000-00" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm font-mono">
                                </div>
                                <div>
                                    <label for="categoria" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Categoria (Ex: Tecidos, Aviamentos)</label>
                                    <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telefone" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Telefone / WhatsApp</label>
                                    <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}" placeholder="(00) 00000-0000" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm font-mono">
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">E-mail</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                </div>
                            </div>

                            <div>
                                <label for="endereco" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Endereço Completo</label>
                                <textarea name="endereco" id="endereco" rows="2" class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">{{ old('endereco') }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('fornecedores') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4">Cancelar</a>
                                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg shadow-md text-sm">Salvar Fornecedor</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>