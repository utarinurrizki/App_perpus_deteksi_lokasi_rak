<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rack;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $books = Book::latest()->get();
        $racks = DB::table('racks')
            ->select(
                'id',
                'nama_rak',
                'zona',
                'baris',
                'sekat_mulai',
                'sekat_selesai'
            )
            ->get();
        $latestBooks = $books->take(5);

        $stats = [
            'total_buku' => $books->count(),
            'total_rak' => $racks->count(),
            'buku_tanpa_cover' => $books->whereNull('cover')->count(),
            'kategori_unik' => $books->pluck('kategori')
                    ->filter(function ($kategori) {
                        return !empty($kategori) && trim($kategori) !== '-';
                    })
                    ->unique()
                    ->count(),
        ];

        return view('admin.dashboard', compact('stats', 'latestBooks'));
    }

    public function books()
    {
        $books = Book::latest()->get();
        $racks = DB::table('racks')
            ->select(
                'id',
                'nama_rak',
                'zona',
                'baris',
                'sekat_mulai',
                'sekat_selesai'
            )
            ->get();

        return view('admin.book.books', compact('books', 'racks'));
    }

    public function racks()
    {
        $racks = Rack::latest()->get();
        return view('admin.rack.racks', compact('racks'));
    }

    public function show(Book $book)
    {
        return view('admin.book.book-detail', compact('book'));
    }
    
}
