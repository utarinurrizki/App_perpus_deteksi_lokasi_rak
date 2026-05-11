<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $books = Book::latest()->get();
        $racks = DB::table('racks')->select('id', 'nama_rak', 'lokasi')->get();
        $latestBooks = $books->take(5);

        $stats = [
            'total_buku' => $books->count(),
            'total_rak' => $racks->count(),
            'buku_tanpa_cover' => $books->whereNull('cover')->count(),
            'kategori_unik' => $books->pluck('kategori')->filter()->unique()->count(),
        ];

        return view('admin.dashboard', compact('stats', 'latestBooks'));
    }

    public function books()
    {
        $books = Book::latest()->get();
        $racks = DB::table('racks')->select('id', 'nama_rak', 'lokasi')->get();

        return view('admin.books', compact('books', 'racks'));
    }

    public function members()
    {
        $members = User::latest()->get();
        return view('admin.members', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'isbn' => 'required|string|max:30',
            'jumlah_halaman' => 'required|string|max:100',
            'edisi' => 'required|string|max:50',
            'jumlah_buku' => 'nullable|integer|min:0',
            // 'status' => 'required|in:tersedia,tidak tersedia',
            'tahun' => 'nullable|digits:4|integer',
            'kategori' => 'nullable|string|max:100',
            'rak_id' => 'required|exists:racks,id',
            'cover' => 'nullable|image|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/cover');

            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
        }

        Book::create([
            'judul' => $validated['judul'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'edisi' => $request->edisi,
            'jumlah_buku' => $request->jumlah_buku,
            // 'status' => $validated['status'],
            'tahun' => $validated['tahun'] ?? null,
            'kategori' => $validated['kategori'] ?? null,
            'rak_id' => $validated['rak_id'],
            'cover' => $filename,
        ]);

        return redirect('/admin/books')->with('success', 'Data buku berhasil disimpan.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'isbn' => 'required|string|max:30',
            'jumlah_halaman' => 'required|string|max:100',
            'edisi' => 'required|string|max:50',
            // 'status' => 'required|in:tersedia,tidak tersedia',
            'jumlah_buku' => 'nullable|integer|min:0',
            'tahun' => 'nullable|digits:4|integer',
            'kategori' => 'nullable|string|max:100',
            'rak_id' => 'required|exists:racks,id',
            'cover' => 'nullable|image|max:2048',
        ]);

        $filename = $book->cover;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/cover');

            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }

            $oldFilePath = public_path('images/cover/' . $book->cover);
            if ($book->cover && File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $file->move($destination, $filename);
        }

        $book->update([
            'judul' => $validated['judul'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'edisi' => $request->edisi,
            'jumlah_buku' => $request->jumlah_buku,
            // 'status' => $validated['status'],
            'tahun' => $validated['tahun'] ?? null,
            'kategori' => $validated['kategori'] ?? null,
            'rak_id' => $validated['rak_id'],
            'cover' => $filename,
        ]);

        return redirect('/admin/books')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $filePath = public_path('images/cover/' . $book->cover);
        if ($book->cover && File::exists($filePath)) {
            File::delete($filePath);
        }

        $book->delete();

        return redirect('/admin/books')->with('success', 'Data buku berhasil dihapus.');
    }

}
