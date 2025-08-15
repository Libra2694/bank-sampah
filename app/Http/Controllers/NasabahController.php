<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nasabahs = Nasabah::latest()->paginate(10);
        return view('nasabah.index', compact('nasabahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nasabah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|unique:nasabahs,email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/nasabah', $filename);
            $data['foto'] = 'nasabah/' . $filename;
        }

        Nasabah::create($data);

        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        return view('nasabah.show', compact('nasabah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nasabah $nasabah)
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|unique:nasabahs,email,' . $nasabah->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($nasabah->foto) {
                Storage::delete('public/' . $nasabah->foto);
            }
            
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public/nasabah', $filename);
            $data['foto'] = 'nasabah/' . $filename;
        }

        $nasabah->update($data);

        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        // Hapus foto jika ada
        if ($nasabah->foto) {
            Storage::delete('public/' . $nasabah->foto);
        }
        
        $nasabah->delete();
        
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus');
    }
}
