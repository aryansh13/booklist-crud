@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4 text-2xl font-bold">
                Library
            </div>
            <nav class="mt-4">
                <a href="#" class="block py-2 px-4 bg-gray-700">Books</a>
                <a href="{{ route('categories.index') }}" class="block py-2 px-4 hover:bg-gray-700">Categories</a>
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
                    Books List
                </h1>
                <button onclick="openModal()"
                    class="bg-indigo-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-600">
                    Add New Book
                </button>
            </div>

            <!-- Filters -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search Form -->
                    <form action="{{ route('books.search') }}" method="GET" class="space-y-2">
                        <label for="search" class="block text-sm font-medium text-gray-700">Search Books</label>
                        <div class="flex">
                            <input type="text" name="search" id="search" class="w-full border border-gray-300 rounded-l-md p-2" placeholder="Search Title, Author, Publisher">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Category Filter Form -->
                    <form action="{{ route('books.filterByCategory') }}" method="GET" class="space-y-2">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Filter by Category</label>
                        <div class="flex">
                            <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded-l-md">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Filter
                            </button>
                        </div>
                    </form>

                    <!-- Publication Date Filter Form -->
                    <form action="{{ route('books.filterByPublicationDate') }}" method="GET" class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Filter by Publication Date</label>
                        <div class="flex">
                            <input type="date" name="publication_date_start" class="w-full p-2 border border-gray-300 rounded-l-md">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-r-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Clear Filters -->
                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Clear All Filters
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Title</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Author</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Publisher</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Publication Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Number of Pages</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $item->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->author }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->publisher }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->publication_date }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->number_of_pages }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->category->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="javascript:void(0);" onclick="openEditModal({{ $item->id }})"
                                        class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('books.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this book?');">
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
            @include('books.create')
            @include('books.edit')
        </div>
    </div>
    <script>
        function openModal() {
            document.getElementById('addBookModal').classList.remove('hidden');
        }

        function openEditModal(bookId) {
            // Lakukan request Ajax untuk mendapatkan data buku berdasarkan ID
            fetch(`/books/${bookId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi data dalam form modal
                    document.getElementById('editTitle').value = data.title;
                    document.getElementById('editAuthor').value = data.author;
                    document.getElementById('editPublisher').value = data.publisher;
                    document.getElementById('editPublicationDate').value = data.publication_date;
                    document.getElementById('editNumberOfPages').value = data.number_of_pages;
                    document.getElementById('editCategoryId').value = data.category_id;

                    // Set form action ke URL update
                    document.getElementById('editBookForm').action = `/books/${bookId}`;

                    // Tampilkan modal edit
                    document.getElementById('editBookModal').classList.remove('hidden');
                })
                .catch(error => console.error('Error fetching book data:', error));
        }
    </script>
@endsection
