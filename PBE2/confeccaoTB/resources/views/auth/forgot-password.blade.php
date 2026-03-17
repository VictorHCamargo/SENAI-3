<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Recuperar Acesso</h2>
    </div>

    <div class="mb-6 text-sm text-gray-600 leading-relaxed bg-indigo-50 p-4 rounded-lg border border-indigo-100">
        {{ __('Esqueceu sua senha? Sem problemas. Apenas informe seu endereço de e-mail e nós enviaremos um link de redefinição de senha para que você possa escolher uma nova.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 transition w-full justify-center">
                {{ __('Enviar Link de Redefinição') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>