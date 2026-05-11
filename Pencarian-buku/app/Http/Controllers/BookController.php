<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
Use App\Models\Rack;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $books = Book::with('rack')
            ->where('judul','LIKE',"%$keyword%")
            ->orWhere('pengarang','LIKE',"%$keyword%")
            ->get();

        return response()->json($books);
    }

    public function detail($id)
    {
        $book = Book::findOrFail($id);
        return view('user.detail', compact('book'));
    }


    //tambah baru
    public function create()
    {
        $racks = Rack::all();
        return view('admin.create', compact('racks'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $racks = Rack::all();

        return view('admin.edit', compact('book', 'racks'));
    }
}
