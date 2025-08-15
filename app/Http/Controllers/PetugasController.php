<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::orderBy('nama')->get();
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:15',
        'email' => 'required|email|unique:petugas',
        'status' => 'required|in:aktif,nonaktif',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('petugas', 'public');
    }

    Petugas::create($validated);

    return redirect()->route('petugas.index')
        ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function show(Petugas $petuga)
    {
        return view('petugas.show', compact('petuga'));
    }

    public function edit(Petugas $petuga)
    {
        return view('petugas.edit', compact('petuga'));
    }

    public function update(Request $request, Petugas $petuga)
    {
        $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:15',
        'email' => 'required|email|unique:petugas,email,'.$petuga->id,
        'status' => 'required|in:aktif,nonaktif',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'hapus_foto' => 'sometimes|boolean',
    ]);

    if ($request->has('hapus_foto') && $request->hapus_foto) {
        Storage::disk('public')->delete($petuga->foto);
        $validated['foto'] = null;
    } elseif ($request->hasFile('foto')) {
        Storage::disk('public')->delete($petuga->foto);
        $validated['foto'] = $request->file('foto')->store('petugas', 'public');
    }

    $petuga->update($validated);

    return redirect()->route('petugas.index')
        ->with('success', 'Data petugas berhasil diperbarui');
    }

    public function destroy(Petugas $petuga)
    {
        if ($petuga->foto) {
            Storage::disk('public')->delete($petuga->foto);
        }
        
        $petuga->delete();
        
        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil dihapus');
    }
}