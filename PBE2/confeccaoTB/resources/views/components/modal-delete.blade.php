<div id="globalDeleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center transition-opacity">
    <div class="relative p-8 border w-96 shadow-2xl rounded-2xl bg-white text-center">
        <div class="text-red-500 mb-4 flex justify-center">
            <svg class="w-16 h-16 bg-red-50 p-3 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-2">Confirmar Exclusão</h3>
        <p class="text-sm text-gray-500 mb-6">
            Tem certeza que deseja excluir <span id="deleteItemName" class="font-bold text-gray-800">este item</span>? Esta ação não pode ser desfeita.
        </p>

        <div class="flex justify-center gap-3">
            <button onclick="closeDeleteModal()" type="button" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold transition-colors text-sm w-full">
                Cancelar
            </button>
            <form id="deleteModalForm" method="POST" action="" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition-colors text-sm w-full shadow-sm">
                    Sim, Excluir
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function openDeleteModal(url, itemName = 'este registro') {
        document.getElementById('deleteModalForm').action = url;
        document.getElementById('deleteItemName').innerText = itemName;
        document.getElementById('globalDeleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('globalDeleteModal').classList.add('hidden');
        document.getElementById('deleteModalForm').action = '';
    }
</script>