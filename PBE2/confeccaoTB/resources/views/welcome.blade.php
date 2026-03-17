<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sistema de Confecção') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-gray-50 text-gray-800 font-sans antialiased selection:bg-indigo-500 selection:text-white">
        
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="font-bold text-xl tracking-tight text-indigo-600 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                    <span>Confecção<span class="text-gray-800">Modelo</span></span>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition">Meu Painel</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition">Área do Cliente</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md transition shadow-sm">Cadastre-se</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main class="py-16 lg:py-32 bg-indigo-50 border-b border-indigo-100 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                    Qualidade e Precisão em <br class="hidden sm:block">
                    <span class="text-indigo-600">Confecção Têxtil</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto mb-10">
                    Transformamos a sua ideia em peças de alto padrão. Da modelagem detalhista ao acabamento perfeito, cuidamos de toda a produção da sua marca ou uniforme.
                </p>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-indigo-600 text-white font-bold px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-0.5">Acessar Meus Pedidos</a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white font-bold px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-0.5">Seja nosso Cliente</a>
                    <a href="{{ route('login') }}" class="inline-block ml-4 bg-white text-indigo-600 border border-indigo-200 font-bold px-8 py-3 rounded-md shadow-sm hover:bg-gray-50 transition">Fazer Login</a>
                @endauth
            </div>
        </main>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:flex lg:items-center lg:gap-16">
                    <div class="lg:w-1/2 mb-10 lg:mb-0">
                        <div class="aspect-video bg-gray-200 rounded-xl shadow-inner flex items-center justify-center text-gray-400 border border-gray-100 relative overflow-hidden">
                            <span class="text-sm font-medium">[ Espaço para Foto da Produção / Costura ]</span>
                        </div>
                    </div>
                    <div class="lg:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Nossa História & Compromisso</h2>
                        <p class="text-gray-600 mb-5 leading-relaxed">
                            Com anos de experiência no mercado de Private Label e moda institucional, nascemos com o propósito de elevar o padrão da indústria de confecção nacional. Nosso foco é a parceria a longo prazo.
                        </p>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Trabalhamos lado a lado com você, garantindo transparência em cada etapa. Nosso maquinário de ponta, aliado a uma equipe de costureiras altamente capacitada, nos permite entregar peças com acabamento impecável e respeito rigoroso aos prazos de entrega.
                        </p>
                        
                        <ul class="space-y-4 text-gray-700 font-medium">
                            <li class="flex items-center gap-3">
                                <span class="bg-indigo-100 text-indigo-600 p-1 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                                Produção em média e larga escala
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-indigo-100 text-indigo-600 p-1 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                                Matéria-prima selecionada a dedo
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="bg-indigo-100 text-indigo-600 p-1 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                                Rastreabilidade do seu pedido
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-gray-50 border-t border-gray-100 text-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Etapas da Nossa Produção</h2>
                <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Do risco do molde à embalagem final, controlamos todo o processo internamente para garantir o máximo de excelência.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Modelagem e Corte</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Desenvolvimento de moldes precisos para garantir o caimento ideal. Nosso corte otimiza o uso do tecido, evitando desperdícios e barateando o custo final.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Costura Industrial</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Equipamentos específicos para cada tipo de tecido (malha, plano, jeans) operados por profissionais rigorosos, entregando durabilidade e costuras alinhadas.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Revisão e Qualidade</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Nenhuma peça sai da nossa fábrica sem passar por um pente fino. Revisamos linhas soltas, medidas e manchas antes do passamento e da embalagem final.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-gray-900 text-gray-400 py-8 text-center border-t border-gray-800">
            <p class="text-sm">
                &copy; {{ date('Y') }} Confecção Modelo. Todos os direitos reservados.
            </p>
        </footer>

    </body>
</html>