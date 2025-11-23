<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSurat;

class JenisSuratController extends Controller
{
  public function index(Request $request)
{
    // Searchable columns
    $searchableColumns = ['kode', 'nama_jenis'];

    $query = JenisSurat::search($request, $searchableColumns);

    // Filter by kode
    if ($request->filled('kode')) {
        $query->where('kode', $request->kode);
    }

    // Filter by syarat
    if ($request->filled('syarat')) {
        if ($request->syarat === 'with') {
            $query->whereNotNull('syarat_json')->where('syarat_json', '!=', '');
        } elseif ($request->syarat === 'without') {
            $query->whereNull('syarat_json')->orWhere('syarat_json', '');
        }
    }

    $surats = $query->orderBy('created_at', 'desc')
                   ->paginate(9)
                   ->withQueryString();

    return view('pages.jenis_surat.index', compact('surats'));
}
    public function create()
    {
        return view('pages.jenis_surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
        ]);

        if (!empty($validated['syarat_json'])) {
            $syarat_array = array_map('trim', explode(',', $validated['syarat_json']));
            $validated['syarat_json'] = json_encode($syarat_array);
        }

        JenisSurat::create($validated);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan.'); // HAPUS 'admin.'
    }

    public function edit($id)
    {
        $surat = JenisSurat::findOrFail($id);
        return view('pages.jenis_surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode,' . $id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string'
        ]);

        if (!empty($validated['syarat_json'])) {
            $syarat_array = array_map('trim', explode(',', $validated['syarat_json']));
            $validated['syarat_json'] = json_encode($syarat_array);
        }

        $surat->update($validated);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil diperbarui.'); // HAPUS 'admin.'
    }

    public function destroy($id)
    {
        JenisSurat::findOrFail($id)->delete();
        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus.'); // HAPUS 'admin.'
    }
}
