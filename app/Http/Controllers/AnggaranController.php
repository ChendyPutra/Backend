<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function index()
    {
        $anggarans = Anggaran::all();
        return response()->json(['data' => $anggarans]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_anggaran' => 'required|date',
            'keterangan_anggaran' => 'required|string',
            'jumlah_anggaran' => 'required|numeric|min:0',
            'rencana_anggaran' => 'required|string',
        ]);

        $anggaran = Anggaran::create($validated);

        return response()->json(['data' => $anggaran, 'message' => 'Anggaran berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        return response()->json(['data' => $anggaran]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_anggaran' => 'required|date',
            'keterangan_anggaran' => 'required|string',
            'jumlah_anggaran' => 'required|numeric|min:0',
            'rencana_anggaran' => 'required|string',
        ]);

        $anggaran = Anggaran::findOrFail($id);
        $anggaran->update($validated);

        return response()->json(['data' => $anggaran, 'message' => 'Anggaran berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $anggaran->delete();

        return response()->json(['message' => 'Anggaran berhasil dihapus']);
    }
}
