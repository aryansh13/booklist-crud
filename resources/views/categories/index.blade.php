@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4 text-2xl font-bold">
                Library
            </div>
            <nav class="mt-4">
                <a href="{{ route('books.index') }}" class="block py-2 px-4 hover:bg-gray-700">Books</a>
                <a href="#" class="block py-2 px-4 bg-gray-700">Categories</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <!-- Navbar -->
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-4xl font-extrabold text-gray-800">
                    Books Category List
                </h1>
                <button onclick="openModal()"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-600">
                    Add New Category
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Name Category</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $item->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <button onclick="openEditModal({{ $item->id }})" class="text-blue-500 hover:underline">Edit</button> |
                                    <form action="{{ route('categories.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-end">
                <nav class="flex">
                    <a href="#" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-l hover:bg-gray-300">Previous</a>
                    <a href="#" class="px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300">1</a>
                    <a href="#" class="px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300">2</a>
                    <a href="#" class="px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-300">3</a>
                    <a href="#" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-r hover:bg-gray-300">Next</a>
                </nav>
            </div>

            <!-- Include the modal -->
            @include('categories.create')
            @include('categories.edit')
        </div>
    </div>
    <script>
        function openModal() {
            document.getElementById('addCategoriesModal').classList.remove('hidden');
        }

        function openEditModal(categoryId) {
            fetch(`/categories/${categoryId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editName').value = data.name;
                    document.getElementById('editCategoriesForm').action = `/categories/${categoryId}`;
                    document.getElementById('editCategoriesModal').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching category data:', error));
        }
    </script>
@endsection
