<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::with('admin')->latest()->get();
        return response()->json(['data' => $pengeluarans]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_pengeluaran' => 'required|string',
            'jumlah_pengeluaran' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
            'keterangan_pengeluaran' => 'nullable|string',
        ]);

        $pengeluaran = Pengeluaran::create(array_merge($validated, [
            'admin_id' => auth('admin')->id(),
        ]));

        return response()->json(['data' => $pengeluaran, 'message' => 'Pengeluaran berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::with('admin')->findOrFail($id);
        return response()->json(['data' => $pengeluaran]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kategori_pengeluaran' => 'required|string',
            'jumlah_pengeluaran' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'required|date',
            'keterangan_pengeluaran' => 'nullable|string',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($validated);

        return response()->json(['data' => $pengeluaran, 'message' => 'Pengeluaran berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json(['message' => 'Pengeluaran berhasil dihapus']);
    }
}
