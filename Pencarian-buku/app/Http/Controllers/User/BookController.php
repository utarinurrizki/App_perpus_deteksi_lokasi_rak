<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $books = Book::with('rack')
            ->where('judul', 'LIKE', "%$keyword%")
            ->orWhere('pengarang', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($books);
    }

    public function detail($id)
    {
        $book = Book::with('rack')->findOrFail($id);

        return view('user.detail', compact('book'));
    }
}
