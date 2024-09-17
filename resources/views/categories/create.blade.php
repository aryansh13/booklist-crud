<div id="addCategoriesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Add New Category</h2>
        <form id="addBookForm" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" name="name" placeholder="Category Name" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal()" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Add Category</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('addCategoriesModal').classList.add('hidden');
    }
</script>
