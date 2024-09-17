<div id="editCategoriesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Edit Category</h2>
        <form id="editCategoriesForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input id="editName" type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeEditModal()" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Category</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditModal() {
        document.getElementById('editCategoriesModal').classList.add('hidden');
    }
</script>
