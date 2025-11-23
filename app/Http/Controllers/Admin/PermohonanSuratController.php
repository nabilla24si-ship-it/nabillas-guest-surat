<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermohonanSurat;
use App\Models\JenisSurat;
use App\Models\Warga;
use Illuminate\Support\Str;

class PermohonanSuratController extends Controller
{
     public function index(Request $request)
    {
        // Searchable columns
        $searchableColumns = ['nomor_pemohonan', 'catatan'];

        // Query dengan relations, search, dan filter
        $query = PermohonanSurat::with(['pemohon', 'jenisSurat'])
                               ->search($request, $searchableColumns);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_id', $request->jenis_surat);
        }

        // Filter by tanggal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_pengajuan', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_pengajuan', '<=', $request->tanggal_selesai);
        }

        $permohonans = $query->latest()
                            ->paginate(12)
                            ->withQueryString();

        $jenisSuratList = JenisSurat::all();
        $statusList = ['pending', 'diproses', 'ditolak', 'selesai'];

        return view('pages.permohonan_surat.index', compact('permohonans', 'jenisSuratList', 'statusList'));
    }

    public function create()
    {
        $jenisSurat = JenisSurat::all();
        $warga = Warga::all();
        return view('pages.permohonan_surat.create', compact('jenisSurat', 'warga'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Generate nomor pemohonan
        $nomorPemohonan = 'PS-' . date('Ymd') . '-' . Str::random(6);

        PermohonanSurat::create([
            'nomor_pemohonan' => $nomorPemohonan,
            'pemohon_warga_id' => $validated['pemohon_warga_id'],
            'jenis_id' => $validated['jenis_id'],
            'tanggal_pengajuan' => now(),
            'status' => 'pending',
            'catatan' => $validated['catatan']
        ]);

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil diajukan.');
    }

    public function show($id)
    {
        $permohonan = PermohonanSurat::with(['pemohon', 'jenisSurat'])->findOrFail($id);
        return view('pages.permohonan_surat.show', compact('permohonan'));
    }

    public function edit($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $jenisSurat = JenisSurat::all();
        $warga = Warga::all();
        return view('pages.permohonan_surat.edit', compact('permohonan', 'jenisSurat', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $validated = $request->validate([
            'pemohon_warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'status' => 'required|in:pending,diproses,ditolak,selesai',
            'catatan' => 'nullable|string|max:500'
        ]);

        $permohonan->update($validated);

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PermohonanSurat::findOrFail($id)->delete();
        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil dihapus.');
    }
}
