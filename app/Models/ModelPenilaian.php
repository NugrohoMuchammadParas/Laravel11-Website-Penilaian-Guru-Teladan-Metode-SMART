<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModelPenilaian extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = ['id_penilaian', 'id_alternatif', 'id_guru', 'rencana_pelaksanaan_pembelajaran', 'kriteria_ketuntasan_minimal', 'pembuatan_soal', 'absensi_kehadiran', 'ketepatan_waktu', 'nilai', 'rank'];


    public function getAll()
    {
        return self::all();
    }

    public function getById($id)
    {
        return self::find($id);
    }

    public function guru()
    {
        return $this->belongsTo(ModelGuru::class, 'id_guru', 'id_guru');
    }

    public function cekData($data)
    {
        return self::where('id_penilaian', $data['id_penilaian'])->get();
    }

    public function tambah($data)
    {
        self::create($data);
    }

    public function ubah($id, $data)
    {
        $penilaian = self::find($id);
        $penilaian->update($data);
    }

    public function hapus($id)
    {
        $penilaian = self::find($id);
        $penilaian->delete($id);
    }

    public function getOrderedByRank()
    {
        return self::join('guru', 'penilaian.id_guru', '=', 'guru.id_guru')
            ->select('penilaian.*', 'guru.nama as nama')
            ->orderBy('rank', 'asc')->get();
    }
}
