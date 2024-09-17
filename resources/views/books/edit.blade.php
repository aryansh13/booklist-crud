<div id="editBookModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4">Edit Book</h2>
        <form id="editBookForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Title</label>
                <input id="editTitle" type="text" name="title" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Author</label>
                <input id="editAuthor" type="text" name="author" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Publisher</label>
                <input id="editPublisher" type="text" name="publisher" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Publication Date</label>
                <input id="editPublicationDate" type="date" name="publication_date" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Number of Pages</label>
                <input id="editNumberOfPages" type="number" name="number_of_pages" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category</label>
                <select id="editCategoryId" name="category_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeEditModal()" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update Book</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditModal() {
        document.getElementById('editBookModal').classList.add('hidden');
    }
</script>
