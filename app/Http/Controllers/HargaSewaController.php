<?php

namespace App\Http\Controllers;

use App\Models\HargaSewa;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class HargaSewaController extends Controller
{
    public function index()
    {
        $hargaSewa = HargaSewa::with('ruangan')->latest()->paginate(10);
        return view('backend.harga.index', compact('hargaSewa'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        return view('backend.harga.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:0',
            'tipe' => 'required|string|in:Latihan,Rekaman,Podcast',
            'ruangan_id' => 'nullable|exists:ruangan,id',
        ]);

        HargaSewa::create([
            'harga' => $request->harga,
            'tipe' => $request->tipe,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect()->route('backend.harga.index')->with('success', 'Harga sewa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $hargaSewa = HargaSewa::findOrFail($id);
        $ruangan = Ruangan::all();
        return view('backend.harga.edit', compact('hargaSewa', 'ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'harga' => 'required|numeric|min:0',
            'tipe' => 'required|string|in:Latihan,Rekaman,Podcast',
            'ruangan_id' => 'nullable|exists:ruangan,id',
        ]);

        $hargaSewa = HargaSewa::findOrFail($id);

        $hargaSewa->update([
            'harga' => $request->harga,
            'tipe' => $request->tipe,
            'ruangan_id' => $request->ruangan_id,
        ]);

        return redirect()->route('backend.harga.index')->with('success', 'Harga sewa berhasil diupdate.');
    }

    public function destroy($id)
    {
        $hargaSewa = HargaSewa::findOrFail($id);
        $hargaSewa->delete();

        return redirect()->route('backend.harga.index')->with('success', 'Harga sewa berhasil dihapus.');
    }
}
