<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rack;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    public function create()
    {
        $racks = Rack::all();
        return view('admin.book.create', compact('racks'));
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
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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

        $jumlah = (int) ($request->jumlah_buku ?? 0);

        Book::create([
            'judul' => $validated['judul'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'edisi' => $request->edisi,
            'jumlah_buku' => $request->jumlah_buku,
            'status' => $jumlah > 0 ? 'tersedia' : 'tidak tersedia',
            'tahun' => $validated['tahun'] ?? null,
            'kategori' => $validated['kategori'] ?? null,
            'rak_id' => $validated['rak_id'],
            'cover' => $filename,
        ]);

        return redirect('/admin/books')->with('success', 'Data buku berhasil disimpan.');
    }

    public function edit(Book $book)
    {
        $racks = Rack::all();
        return view('admin.book.edit', compact('book', 'racks'));
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
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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

        $jumlah = (int) ($request->jumlah_buku ?? 0);

        $book->update([
            'judul' => $validated['judul'],
            'pengarang' => $validated['pengarang'],
            'penerbit' => $validated['penerbit'],
            'isbn' => $request->isbn,
            'jumlah_halaman' => $request->jumlah_halaman,
            'edisi' => $request->edisi,
            'jumlah_buku' => $request->jumlah_buku,
            'status' => $jumlah > 0 ? 'tersedia' : 'tidak tersedia',
            'tahun' => $validated['tahun'] ?? null,
            'kategori' => $validated['kategori'] ?? null,
            'rak_id' => $validated['rak_id'],
            'cover' => $filename,
        ]);

        return redirect('/admin/books')->with('success', 'Data buku berhasil diubah.');
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
