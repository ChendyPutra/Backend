<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukans = Pemasukan::with('admin')->latest()->get();
        return response()->json(['data' => $pemasukans]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sumber_dana' => 'required|string',
            'jumlah_pemasukan' => 'required|numeric|min:0',
            'tanggal_pemasukan' => 'required|date',
            'keterangan_pemasukan' => 'nullable|string',
        ]);

        $pemasukan = Pemasukan::create(array_merge($validated, [
            'admin_id' => auth('admin')->id(),
        ]));

        return response()->json(['data' => $pemasukan, 'message' => 'Pemasukan berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $pemasukan = Pemasukan::with('admin')->findOrFail($id);
        return response()->json(['data' => $pemasukan]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sumber_dana' => 'required|string',
            'jumlah_pemasukan' => 'required|numeric|min:0',
            'tanggal_pemasukan' => 'required|date',
            'keterangan_pemasukan' => 'nullable|string',
        ]);

        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->update($validated);

        return response()->json(['data' => $pemasukan, 'message' => 'Pemasukan berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return response()->json(['message' => 'Pemasukan berhasil dihapus']);
    }
}
