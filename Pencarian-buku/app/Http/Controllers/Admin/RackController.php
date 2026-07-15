<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    public function create()
    {
        return view('admin.rack.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_rak' => 'required|string|max:100',
            'zona' => 'required|string|max:255',
            'baris' => 'required|integer|min:0',
            'sekat_mulai' => 'required|integer|min:0',
            'sekat_selesai' => 'required|integer|min:0',
        ]);

        Rack::create($validated);

        return redirect('/admin/racks')->with('success', 'Data rak berhasil ditambahkan.');
    }

    public function edit(Rack $rack)
    {
        return view('admin.rack.edit', compact('rack'));
    }

    public function update(Request $request, Rack $rack)
    {
        $validated = $request->validate([
            'nama_rak' => 'required|string|max:100',
            'zona' => 'required|string|max:255',
            'baris' => 'required|integer|min:0',
            'sekat_mulai' => 'required|integer|min:0',
            'sekat_selesai' => 'required|integer|min:0',
        ]);

        $rack->update($validated);

        return redirect('/admin/racks')->with('success', 'Data rak berhasil diubah.');
    }

    public function destroy(Rack $rack)
    {
        $rack->delete();

        return redirect('/admin/racks')->with('success', 'Data rak berhasil dihapus.');
    }
}
