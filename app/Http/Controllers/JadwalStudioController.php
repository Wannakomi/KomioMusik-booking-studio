<?php

namespace App\Http\Controllers;

use App\Models\JadwalStudio;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalStudioController extends Controller
{
    public function index()
    {
        $jadwal = JadwalStudio::with('ruangan')->latest()->paginate(10);
        return view('backend.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        return view('backend.jadwal.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        JadwalStudio::create([
            'ruangan_id' => $request->ruangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tersedia' => $request->boolean('tersedia'),
        ]);

        return redirect()->route('backend.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalStudio::findOrFail($id);
        $ruangan = Ruangan::all();
        return view('backend.jadwal.edit', compact('jadwal', 'ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jadwal = JadwalStudio::findOrFail($id);
        $jadwal->update([
            'ruangan_id' => $request->ruangan_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tersedia' => $request->boolean('tersedia'),
        ]);

        return redirect()->route('backend.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalStudio::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('backend.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
