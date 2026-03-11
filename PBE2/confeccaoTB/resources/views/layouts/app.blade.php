<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <x-modal-delete/>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // Função para aplicar máscara de CPF (000.000.000-00)
            const mascaraCPF = (valor) => {
                return valor.replace(/\D/g, '')
                            .replace(/(\d{3})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d{1,2})/, '$1-$2')
                            .replace(/(-\d{2})\d+?$/, '$1');
            };

            // Função para aplicar máscara de CNPJ (00.000.000/0000-00)
            const mascaraCNPJ = (valor) => {
                return valor.replace(/\D/g, '')
                            .replace(/(\d{2})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d)/, '$1.$2')
                            .replace(/(\d{3})(\d)/, '$1/$2')
                            .replace(/(\d{4})(\d{1,2})/, '$1-$2')
                            .replace(/(-\d{2})\d+?$/, '$1');
            };

            // Função para aplicar máscara de Telefone ( (00) 00000-0000 )
            const mascaraTelefone = (valor) => {
                let v = valor.replace(/\D/g, '');
                if (v.length <= 10) {
                    return v.replace(/(\d{2})(\d)/, '($1) $2')
                            .replace(/(\d{4})(\d)/, '$1-$2')
                            .replace(/(-\d{4})\d+?$/, '$1');
                } else {
                    return v.replace(/(\d{2})(\d)/, '($1) $2')
                            .replace(/(\d{5})(\d)/, '$1-$2')
                            .replace(/(-\d{4})\d+?$/, '$1');
                }
            };

            // Aplica os eventos nos inputs baseados no atributo 'name' ou 'id'
            document.querySelectorAll('input[name="cpf"], input#cpf').forEach(el => {
                // Aplica a máscara logo ao carregar a página (útil para o edit)
                el.value = mascaraCPF(el.value);
                el.addEventListener('input', (e) => e.target.value = mascaraCPF(e.target.value));
            });

            document.querySelectorAll('input[name="cnpj"], input#cnpj').forEach(el => {
                el.value = mascaraCNPJ(el.value);
                el.addEventListener('input', (e) => e.target.value = mascaraCNPJ(e.target.value));
            });

            document.querySelectorAll('input[name="telefone"], input#telefone').forEach(el => {
                el.value = mascaraTelefone(el.value);
                el.addEventListener('input', (e) => e.target.value = mascaraTelefone(e.target.value));
            });
        });
    </script>   
    </body>
</html>
