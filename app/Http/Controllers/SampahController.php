<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sampahs = Sampah::all();
        return view('sampah.index', compact('sampahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sampah.create');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga_per_kg' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('foto')->store('public/sampah');
        $fotoUrl = Storage::url($path);

        Sampah::create([
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'harga_per_kg' => $request->harga_per_kg,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoUrl,
        ]);

        return redirect()->route('sampah.index')
            ->with('success', 'Jenis sampah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sampah $sampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sampah $sampah)
    {
        return view('sampah.edit', compact('sampah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sampah $sampah)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga_per_kg' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto');

        // if ($request->hasFile('foto')) {
        //     // Hapus foto lama jika ada
        //     if ($sampah->foto) {
        //         $oldPhoto = str_replace('/storage', 'public', $sampah->foto);
        //         Storage::delete($oldPhoto);
        //     }
            
        //     $path = $request->file('foto')->store('public/sampah');
        //     $data['foto'] = Storage::url($path);
        // }

        if ($request->hasFile('foto')) {
    $file = $request->file('foto');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads/sampah'), $filename);
    $data['foto'] = 'uploads/sampah/' . $filename;
}

        $sampah->update($data);

        return redirect()->route('sampah.index')
            ->with('success', 'Jenis sampah berhasil diperbarui');
            
        if ($request->has('hapus_foto') && $sampah->foto) {
    $oldPhoto = str_replace('/storage', 'public', $sampah->foto);
    Storage::delete($oldPhoto);
    $data['foto'] = null;
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sampah $sampah)
    {
        // Hapus foto jika ada
        if ($sampah->foto) {
            $oldPhoto = str_replace('/storage', 'public', $sampah->foto);
            Storage::delete($oldPhoto);
        }

        $sampah->delete();

        return redirect()->route('sampah.index')
            ->with('success', 'Jenis sampah berhasil dihapus');
    }
}
