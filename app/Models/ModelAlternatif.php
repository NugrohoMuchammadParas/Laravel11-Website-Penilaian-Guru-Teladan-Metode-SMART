<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModelAlternatif extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $fillable = ['id_alternatif', 'id_akun', 'id_guru', 'rencana_pelaksanaan_pembelajaran', 'kriteria_ketuntasan_minimal', 'pembuatan_soal', 'absensi_kehadiran', 'ketepatan_waktu'];


    public function getAll()
    {
        return self::all();
    }

    public function getById($id)
    {
        return self::find($id);
    }

    public function getMaxId()
    {
        return self::max('id_desimal');
    }

    public function tambah($data)
    {
        self::create($data);
    }

    public function ubah($id, $data)
    {
        $alternatif = self::find($id);
        $alternatif->update($data);
    }

    public function hapus($id)
    {
        $alternatif = self::find($id);
        $alternatif->delete($id);
    }

    public function getMin($data)
    {
        return self::max($data);
    }

    public function getMax($data)
    {
        return self::max($data);
    }

    public function guru()
    {
        return $this->belongsTo(ModelGuru::class, 'id_guru', 'id_guru');
    }

    public function getNameByIdAll()
    {
        return self::join('guru', 'alternatif.id_guru', '=', 'guru.id_guru')
            ->select('alternatif.*', 'guru.nama as nama')
            ->get();
    }

    public function getNameById($id_guru)
    {
        return self::join('guru', 'alternatif.id_guru', '=', 'guru.id_guru')
            ->where('alternatif.id_guru', $id_guru)
            ->select('alternatif.*', 'guru.nama as nama')
            ->first();
    }
}
