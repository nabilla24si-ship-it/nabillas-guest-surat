<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('pages.warga.index', compact('warga'));
    }

    public function create()
    {
        return view('pages.warga.create');
        //////
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.'); // HAPUS 'admin.'
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'email' => 'required|email|unique:warga,email,' . $id . ',warga_id',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.'); // HAPUS 'admin.'
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.'); // HAPUS 'admin.'
    }
}
