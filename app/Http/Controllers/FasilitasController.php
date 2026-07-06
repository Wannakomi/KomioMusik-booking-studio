<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(5);
        return view('backend.fasilitas.index', compact('fasilitas'));
    }
    
    public function create()
    {
        return view('backend.fasilitas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = 'storage/fasilitas/';
            ImageHelper::uploadAndResize($file, $directory, $filename, 385, 400);
            $data['foto'] = $filename;
        }

        Fasilitas::create($data);
        return redirect()->route('backend.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('backend.fasilitas.edit', compact('fasilitas'));        }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('foto')) {
            if ($fasilitas->foto) {
                $oldPath = 'storage/fasilitas/' . $fasilitas->foto;
                if (file_exists($oldPath)) unlink($oldPath);
            }

            $file = $request->file('foto');
            $filename = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = 'storage/fasilitas/';
            ImageHelper::uploadAndResize($file, $directory, $filename, 385, 400);
            $data['foto'] = $filename;
        }

        $fasilitas->update($data);
        return redirect()->route('backend.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        if ($fasilitas->foto) {
            $path = 'storage/fasilitas/' . $fasilitas->foto;
            if (file_exists($path)) unlink($path);
        }

        $fasilitas->delete();
        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}
