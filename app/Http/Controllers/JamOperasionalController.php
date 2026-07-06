<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JamOperasional;

class JamOperasionalController extends Controller
{

    public function index()
    {
        $data = JamOperasional::orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")->get();
        return view('backend.jam_operasional.index', compact('data'));
    }

    public function create()
    {
        return view('backend.jam_operasional.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|unique:jam_operasional,hari',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        JamOperasional::create($request->all());

        return redirect()->route('backend.jam_operasional.index')->with('success', 'Jam operasional berhasil ditambahkan.');
    }

    public function edit(JamOperasional $jam_operasional)
    {
        return view('backend.jam_operasional.edit', compact('jam_operasional'));
    }

    public function update(Request $request, JamOperasional $jam_operasional)
    {
        $request->validate([
            'hari' => 'required|string|unique:jam_operasional,hari,' . $jam_operasional->id,
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $jam_operasional->update($request->all());

        return redirect()->route('backend.jam_operasional.index')->with('success', 'Jam operasional berhasil diperbarui.');
    }

    public function destroy(JamOperasional $jam_operasional)
    {
        $jam_operasional->delete();
        return back()->with('success', 'Jam operasional berhasil dihapus.');
    }
}

