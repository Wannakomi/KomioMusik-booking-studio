<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;


class RuanganController extends Controller
{

    public function index() {
        $ruangan = Ruangan::latest()->paginate(10);
        return view('backend.ruangan.index', compact('ruangan')); 
    }

    public function create() {
        return view('backend.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 2048 KB.'
        ]);
    
        $filename = null;
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/ruangan/';
    
            // Simpan gambar ke folder storage/ruangan (pakai helper resize)
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
    
            $filename = $originalFileName;
        }
    
        Ruangan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
        ]);
    
        return redirect()->route('backend.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }    

    public function edit(Ruangan $ruangan) {
        return view('backend.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika user upload file baru
        if ($request->hasFile('foto')) {
            // Hapus gambar lama
            if ($ruangan->foto) {
                $oldImagePath = public_path('storage/ruangan/') . $ruangan->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload gambar baru
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/ruangan/';

            // Simpan gambar
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Update nama file ke array $data, bukan $validatedData
            $data['foto'] = $originalFileName;
        }

        $ruangan->update($data);

        return redirect()->route('backend.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan) {
        if ($ruangan->foto) {
            Storage::disk('public')->delete($ruangan->foto);
        }

        $ruangan->delete();

        return redirect()->route('backend.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
    
    public function show($id) 
    {
        $ruangan = Ruangan::with(['hargaSewas', 'fasilitas'])->findOrFail($id);
    
        return view('frontend.v_ruangan.detail', compact('ruangan'));
    }

    public function indexFrontend()
    {
        $ruangan = Ruangan::with('hargaSewas', 'fasilitas')->latest()->paginate(6); // Bisa diubah jumlah per page-nya
        return view('frontend.v_ruangan.index', compact('ruangan'));
    }

}
