<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index()
    {
        $warga = Warga::all();
        return view('admin.warga.index', compact('warga'));
    }

    /**
     * Form tambah warga.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Simpan data warga baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // Sesuaikan dengan form
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Form edit data warga.
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Update data warga.
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P', // Sesuaikan dengan form
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|unique:warga,email,' . $id . ',warga_id',
        ]);

        $warga->update($validated);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}