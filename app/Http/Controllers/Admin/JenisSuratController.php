<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSurat;

class JenisSuratController extends Controller
{
    public function index()
    {
        $surats = JenisSurat::all();
        return view('admin.jenis_surat.index', compact('surats'));
    }

    public function create()
    {
        return view('admin.jenis_surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
        ]);

        // Konversi input CSV menjadi JSON
        if (!empty($validated['syarat_json'])) {
            $syarat_array = array_map('trim', explode(',', $validated['syarat_json']));
            $validated['syarat_json'] = json_encode($syarat_array);
        }

        JenisSurat::create($validated);

        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $surat = JenisSurat::findOrFail($id);
        return view('admin.jenis_surat.edit', compact('surat')); // <--- nama variabel benar
    }

    public function update(Request $request, $id)
    {
        $surat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string'
        ]);

        // Konversi input CSV menjadi JSON
        if (!empty($validated['syarat_json'])) {
            $syarat_array = array_map('trim', explode(',', $validated['syarat_json']));
            $validated['syarat_json'] = json_encode($syarat_array);
        }

        $surat->update($validated);

        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JenisSurat::findOrFail($id)->delete();
        return redirect()->route('admin.jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus.');
    }
}
