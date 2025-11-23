<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';

    protected $fillable = [
        'nomor_pemohonan',
        'pemohon_warga_id',
        'jenis_id',
        'tanggal_pengajuan',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
    ];

    public function pemohon()
    {
        return $this->belongsTo(Warga::class, 'pemohon_warga_id', 'warga_id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    // Scope untuk search
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            })
            ->orWhereHas('pemohon', function($q) use ($request) {
                $q->where('nama', 'LIKE', '%' . $request->search . '%');
            })
            ->orWhereHas('jenisSurat', function($q) use ($request) {
                $q->where('nama_jenis', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('kode', 'LIKE', '%' . $request->search . '%');
            });
        }
        return $query;
    }

    // Accessor untuk status label
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => ['text' => 'Menunggu', 'class' => 'warning'],
            'diproses' => ['text' => 'Diproses', 'class' => 'primary'],
            'ditolak' => ['text' => 'Ditolak', 'class' => 'danger'],
            'selesai' => ['text' => 'Selesai', 'class' => 'success']
        ];

        return $labels[$this->status] ?? ['text' => 'Unknown', 'class' => 'secondary'];
    }

    // Method untuk statistik
    public static function getStats()
    {
        $total = self::count();
        $pending = self::where('status', 'pending')->count();
        $diproses = self::where('status', 'diproses')->count();
        $ditolak = self::where('status', 'ditolak')->count();
        $selesai = self::where('status', 'selesai')->count();

        return [
            'total' => $total,
            'pending' => $pending,
            'diproses' => $diproses,
            'ditolak' => $ditolak,
            'selesai' => $selesai,
        ];
    }
}
