<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCategory;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get()->paginate(10);
        $categories = BookCategory::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $books = Book::with('category') 
            ->where('title', 'like', "%{$searchTerm}%")
            ->orWhere('author', 'like', "%{$searchTerm}%")
            ->orWhere('publisher', 'like', "%{$searchTerm}%")
            ->get();

        if ($request->ajax()) {
            return response()->json($books); 
        }

        $categories = BookCategory::all();
        return view('books.index', compact('books', 'categories'));
    }


    public function filterByCategory(Request $request)
    {
        $categoryId = $request->input('category_id');
        $books = Book::where('category_id', $categoryId)->get();
        $categories = BookCategory::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function filterByPublicationDate(Request $request)
    {
        $start = Carbon::parse($request->input('publication_date_start'))->startOfDay();
        $end = Carbon::parse($request->input('publication_date_end'))->endOfDay();
        $books = Book::whereBetween('publication_date', [$start, $end])->get();
        $categories = BookCategory::all();
        return view('books.index', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publication_date' => 'required',
            'number_of_pages' => 'required',
            'category_id' => 'required|exists:book_categories,id',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->publication_date = $request->publication_date;
        $book->number_of_pages = $request->number_of_pages;
        $book->category_id = $request->category_id;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
