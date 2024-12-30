<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ModelPenilaian;

class Penilaian extends Controller
{
    public function index()
    {
        $data_penilaian = new ModelPenilaian();

        $data = [
            'profile' => 'user-profile',
            'halaman' => 'penilaian',
            'logout' => 'logout',
            'penilaian' => $data_penilaian->getOrderedByRank(),
        ];

        return view('user/penilaian/penilaian', $data);
    }
}
