<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ModelGuru extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = ['id_guru', 'id_akun', 'nama', 'lahir', 'telepon', 'email', 'alamat'];


    public function getAll()
    {
        return self::all();
    }

    public function getById($id)
    {
        return self::find($id);
    }

    public function getByName($name)
    {
        return self::where('nama', $name)->first();
    }

    public function getIdByName($nama)
    {
        $result = self::where('nama', $nama)->first();
        return $result ? $result->id_guru : null;
    }

    public function tambah($data)
    {
        self::create($data);
    }

    public function ubah($id, $data)
    {
        $result = self::find($id);
        $result->update($data);
    }

    public function hapus($id)
    {
        $result = self::find($id);
        $result->delete($id);
    }
}
