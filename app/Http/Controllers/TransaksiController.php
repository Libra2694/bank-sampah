<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['nasabah', 'sampah'])
                        ->latest()
                        ->paginate(10);
        
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        $sampahs = Sampah::orderBy('jenis')->get();
        
        return view('transaksi.create', compact('nasabahs', 'sampahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nasabah_id' => 'required|exists:nasabahs,id',
            'sampah_id' => 'required|exists:sampahs,id',
            'berat_kg' => 'required|numeric|min:0.1',
            'harga_per_kg' => 'required|integer|min:1'
        ]);

        // Hitung total
        $validated['total'] = $validated['berat_kg'] * $validated['harga_per_kg'];

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        $sampahs = Sampah::orderBy('jenis')->get();
        
        return view('transaksi.edit', compact('transaksi', 'nasabahs', 'sampahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nasabah_id' => 'required|exists:nasabahs,id',
            'sampah_id' => 'required|exists:sampahs,id',
            'berat_kg' => 'required|numeric|min:0.1',
            'harga_per_kg' => 'required|integer|min:1'
        ]);

        // Hitung total
        $validated['total'] = $validated['berat_kg'] * $validated['harga_per_kg'];

        $transaksi->update($validated);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
