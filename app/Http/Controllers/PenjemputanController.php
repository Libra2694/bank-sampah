<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use App\Models\Nasabah;
use App\Models\Petugas;
use Illuminate\Http\Request;

class PenjemputanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjemputans = Penjemputan::with(['nasabah', 'petugas'])
                        ->latest()
                        ->paginate(10);
        
        return view('penjemputan.index', compact('penjemputans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        $petugas = Petugas::where('status', 'aktif')->orderBy('nama')->get();
        
        return view('penjemputan.create', compact('nasabahs', 'petugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'petugas_id' => 'nullable|exists:petugas,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'status' => 'required|in:menunggu,diproses,selesai,batal',
            'alamat' => 'required|string|max:500',
            'catatan' => 'nullable|string|max:255'
        ]);

        Penjemputan::create($validated);

        return redirect()->route('penjemputan.index')
            ->with('success', 'Penjemputan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjemputan $penjemputan)
    {
        return view('penjemputan.show', compact('penjemputan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjemputan $penjemputan)
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        $petugas = Petugas::where('status', 'aktif')->orderBy('nama')->get();
        
        return view('penjemputan.edit', compact('penjemputan', 'nasabahs', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjemputan $penjemputan)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'petugas_id' => 'nullable|exists:petugas,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:menunggu,diproses,selesai,batal',
            'alamat' => 'required|string|max:500',
            'catatan' => 'nullable|string|max:255'
        ]);

        $penjemputan->update($validated);

        return redirect()->route('penjemputan.index')
            ->with('success', 'Data penjemputan berhasil diperbarui!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjemputan $penjemputan)
    {
        $penjemputan->delete();

        return redirect()->route('penjemputan.index')
            ->with('success', 'Penjemputan berhasil dihapus!');
    }
}
