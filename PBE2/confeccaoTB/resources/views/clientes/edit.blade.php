<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editar Cliente: {{ $cliente->nome }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100" style="border-radius: 12px;">
                <div class="p-8">
                    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            {{-- Nome --}}
                            <div>
                                <label for="nome" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Nome Completo</label>
                                <input type="text" name="nome" id="nome" value="{{ old('nome', $cliente->nome) }}" required
                                    class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                @error('nome') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- CPF --}}
                                <div>
                                    <label for="cpf" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">CPF</label>
                                    <input type="text" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{ old('cpf', $cliente->cpf) }}" placeholder="000.000.000-00"
                                        class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm" readonly>
                                    @error('cpf') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                                {{-- Telefone --}}
                                <div>
                                    <label for="telefone" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Telefone</label>
                                    <input type="text" name="telefone" id="telefone" pattern="^(\(?\d{2}\)?\s?)?9?\d{4}-?\d{4}$" value="{{ old('telefone', $cliente->telefone) }}" placeholder="(00) 00000-0000"
                                        class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm font-mono">
                                    @error('telefone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">E-mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $cliente->email) }}"
                                    class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Endereço --}}
                            <div>
                                <label for="endereco" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1">Endereço Completo</label>
                                <address-textarea> <textarea name="endereco" id="endereco" rows="3"
                                        class="w-full border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500 text-gray-800 shadow-sm">{{ old('endereco', $cliente->endereco) }}</textarea>
                                </address-textarea>
                                @error('endereco') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('clientes') }}" class="text-sm text-gray-500 hover:text-gray-700 mr-4 transition-colors">
                                    Cancelar
                                </a>
                                
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-md text-sm">
                                    Atualizar Cadastro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>