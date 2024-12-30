<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ModelAkun;
use App\Models\ModelGuru;
use App\Models\ModelLaporan;
use App\Models\ModelPenilaian;

class Home extends Controller
{
    public function index()
    {
        $data_guru = new Modelguru();
        $data_akun = new ModelAkun();
        $data_laporan = new ModelLaporan();
        $data_penilaian = new ModelPenilaian();

        $data = [
            'guru' => $data_guru->getAll(),
            'akun' => $data_akun->getAll(),
            'laporan' => $data_laporan->getAll(),
            'penilaian' => $data_penilaian->getAll(),
            'profile' => 'user-profile',
            'halaman' => 'home',
            'logout' => 'logout',
        ];

        return view('user/home/home', $data);
    }
}
