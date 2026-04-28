<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - API</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Usuários do Sistema</h1>

            <form action="{{ route('usuarios') }}" method="GET" class="mb-6 flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}"
                    placeholder="Buscar por nome..." 
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Filtrar
                </button>
                @if(isset($search) && $search)
                    <a href="{{ route('usuarios') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition flex items-center">
                        Limpar
                    </a>
                @endif
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 font-semibold text-gray-700">Foto</th>
                            <th class="p-4 font-semibold text-gray-700">Nome Completo</th>
                            <th class="p-4 font-semibold text-gray-700">E-mail</th>
                            <th class="p-4 font-semibold text-gray-700">Gênero</th>
                            <th class="p-4 font-semibold text-gray-700 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <img src="{{ $user['image'] }}" alt="Avatar" class="w-10 h-10 rounded-full bg-gray-200">
                                </td>
                                <td class="p-4 font-medium text-gray-900">
                                    {{ $user['firstName'] }} {{ $user['lastName'] }}
                                </td>
                                <td class="p-4 text-gray-600">{{ $user['email'] }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs font-bold rounded-full {{ $user['gender'] == 'male' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                        {{ ucfirst($user['gender']) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <button
                                        onclick="openUserModal(<?php echo $user['id']; ?>)"
                                        class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-md hover:bg-indigo-200 transition text-sm font-bold"
                                    >
                                        Ver Detalhes
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="userModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-8 overflow-hidden transform transition-all">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div id="modalLoader" class="flex justify-center py-10">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-indigo-600"></div>
                </div>

                <div id="modalContent" class="hidden">
                    <div class="flex items-center gap-6 mb-8">
                        <img id="m-image" src="" class="w-24 h-24 rounded-full bg-gray-100 border-4 border-indigo-50 shadow-sm">
                        <div>
                            <h2 id="m-name" class="text-3xl font-bold text-gray-800 uppercase tracking-tighter"></h2>
                            <p id="m-title" class="text-indigo-600 font-medium"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b pb-1">Informações Pessoais</h3>
                            <p class="text-sm text-gray-700"><strong>Data Nasc:</strong> <span id="m-birth"></span></p>
                            <p class="text-sm text-gray-700"><strong>Endereço:</strong> <span id="m-address"></span></p>
                            <p class="text-sm text-gray-700"><strong>Cidade/Estado:</strong> <span id="m-city"></span></p>
                        </div>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-xl">
                            <h3 class="text-xs font-bold text-indigo-400 uppercase tracking-widest border-b border-indigo-100 pb-1">Dados Financeiros</h3>
                            <p class="text-sm text-gray-700"><strong>Cartão:</strong> **** **** **** <span id="m-card"></span></p>
                            <p class="text-sm text-gray-700"><strong>IBAN:</strong> <span id="m-iban" class="block truncate text-xs text-gray-500"></span></p>
                            <p id="m-crypto" class="text-[10px] font-mono text-indigo-600 break-all bg-indigo-50 p-2 rounded mt-2"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUserModal(id) {
            const modal = document.getElementById('userModal');
            const loader = document.getElementById('modalLoader');
            const content = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');
            loader.classList.remove('hidden');
            content.classList.add('hidden');

            fetch(`/usuarios/${id}`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('m-image').src = user.image;
                    document.getElementById('m-name').innerText = `${user.firstName} ${user.lastName}`;
                    document.getElementById('m-title').innerText = `${user.company.title} em ${user.company.name}`;
                    document.getElementById('m-birth').innerText = user.birthDate;
                    document.getElementById('m-address').innerText = user.address.address;
                    document.getElementById('m-city').innerText = `${user.address.city}, ${user.address.state}`;
                    document.getElementById('m-card').innerText = user.bank.cardNumber.slice(-4);
                    document.getElementById('m-iban').innerText = user.bank.iban;
                    document.getElementById('m-crypto').innerText = "Wallet: " + user.crypto.wallet;

                    loader.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(err => alert("Erro ao carregar detalhes"));
        }

        function closeModal() {
            document.getElementById('userModal').classList.add('hidden');
        }
    </script>
</body>
</html>