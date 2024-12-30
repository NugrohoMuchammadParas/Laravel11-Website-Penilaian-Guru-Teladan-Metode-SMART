<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ModelGuru;

class Guru extends Controller
{
    public function index()
    {
        $data_guru = new ModelGuru();

        $data = [
            'tambah' => "admin-guru-tambah",
            'ubah' => "admin-guru-ubah",
            'hapus' => "admin-guru-hapus",
            'profile' => 'admin-profile',
            'halaman' => 'guru',
            'logout' => 'logout',
            'guru' => $data_guru->getAll(),
        ];

        return view('user/guru/guru', $data);
    }
}
