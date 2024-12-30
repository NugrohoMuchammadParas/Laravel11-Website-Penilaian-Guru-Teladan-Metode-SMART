<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModelDesimal extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'desimal';
    protected $primaryKey = 'id_desimal';
    protected $fillable = ['id_desimal', 'id_alternatif', 'id_guru', 'rencana_pelaksanaan_pembelajaran', 'kriteria_ketuntasan_minimal', 'pembuatan_soal', 'absensi_kehadiran', 'ketepatan_waktu'];


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

    public function cekData($data)
    {
        return self::where('id_desimal', $data['id_desimal'])->get();
    }

    public function tambah($data)
    {
        self::create($data);
    }

    public function ubah($id, $data)
    {
        $desimal = self::find($id);
        $desimal->update($data);
    }

    public function hapus($id)
    {
        $desimal = self::find($id);
        $desimal->delete($id);
    }

    public function getMin($data)
    {
        return self::min($data);
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
        return self::join('guru', 'desimal.id_guru', '=', 'guru.id_guru')
            ->select('desimal.*', 'guru.nama as nama')
            ->get();
    }

    public function getNameById($id_guru)
    {
        return self::join('guru', 'desimal.id_guru', '=', 'guru.id_guru')
            ->where('desimal.id_guru', $id_guru)
            ->select('desimal.*', 'guru.nama as nama')
            ->first();
    }
}
