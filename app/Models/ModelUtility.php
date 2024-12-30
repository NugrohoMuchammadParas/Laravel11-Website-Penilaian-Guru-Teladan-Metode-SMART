<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModelUtility extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'utility';
    protected $primaryKey = 'id_utility';
    protected $fillable = ['id_utility', 'id_alternatif', 'id_guru', 'rencana_pelaksanaan_pembelajaran', 'kriteria_ketuntasan_minimal', 'pembuatan_soal', 'absensi_kehadiran', 'ketepatan_waktu'];


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
        return self::max('id_utility');
    }

    public function cekData($data)
    {
        return self::where('id_utility', $data['id_utility'])->get();
    }

    public function tambah($data)
    {
        self::create($data);
    }

    public function ubah($id, $data)
    {
        $utility = self::find($id);
        $utility->update($data);
    }

    public function hapus($id)
    {
        $utility = self::find($id);
        $utility->delete($id);
    }

    public function guru()
    {
        return $this->belongsTo(ModelGuru::class, 'id_guru', 'id_guru');
    }

    public function getNameByIdAll()
    {
        return self::join('guru', 'utility.id_guru', '=', 'guru.id_guru')
            ->select('utility.*', 'guru.nama as nama')
            ->get();
    }

    public function getNameById($id_guru)
    {
        return self::join('guru', 'utility.id_guru', '=', 'guru.id_guru')
            ->where('utility.id_guru', $id_guru)
            ->select('utility.*', 'guru.nama as nama')
            ->first();
    }
}
