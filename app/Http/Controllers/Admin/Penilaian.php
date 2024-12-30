<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelAlternatif;
use App\Models\ModelDesimal;
use App\Models\ModelKriteria;
use App\Models\ModelPenilaian;
use App\Models\ModelUtility;

class Penilaian extends Controller
{
    public function index()
    {
        $data_penilaian = new ModelPenilaian();

        $data = [
            'perhitungan' => "admin-penilaian-perhitungan",
            'profile' => 'admin-profile',
            'halaman' => 'penilaian',
            'logout' => 'logout',
            'penilaian' => $data_penilaian->getOrderedByRank(),
        ];

        return view('admin/penilaian/penilaian', $data);
    }

    public function index_perhitungan()
    {
        $data_alternatif = new ModelAlternatif();
        $data_kriteria = new ModelKriteria();
        $data_desimal = new ModelDesimal();
        $data_utility = new ModelUtility();
        $data_penilaian = new ModelPenilaian();

        $data = [
            'kembali' => "admin-penilaian",
            'profile' => 'admin-profile',
            'halaman' => 'penilaian',
            'logout' => 'logout',
            'print_perhitungan' => "admin-perhitungan-print",
            'alternatif' => $data_alternatif->getNameByIdAll(),
            'kriteria' => $data_kriteria->getAll(),
            'desimal' => $data_desimal->getNameByIdAll(),
            'utility' => $data_utility->getNameByIdAll(),
            'penilaian' => $data_penilaian->getOrderedByRank(),
        ];

        return view('admin/penilaian/perhitungan_penilaian', $data);
    }

    public function index_print_penilaian()
    {
        $data_penilaian = new ModelPenilaian();

        $data = [
            'penilaian' => $data_penilaian->getOrderedByRank(),
        ];

        return view('admin/penilaian/print_penilaian', $data);
    }

    public function index_print_perhitungan()
    {
        $data_alternatif = new ModelAlternatif();
        $data_kriteria = new ModelKriteria();
        $data_desimal = new ModelDesimal();
        $data_utility = new ModelUtility();
        $data_penilaian = new ModelPenilaian();

        $data = [
            'alternatif' => $data_alternatif->getNameByIdAll(),
            'kriteria' => $data_kriteria->getAll(),
            'desimal' => $data_desimal->getNameByIdAll(),
            'utility' => $data_utility->getNameByIdAll(),
            'penilaian' => $data_penilaian->getOrderedByRank(),
        ];

        return view('admin/penilaian/print_perhitungan_penilaian', $data);
    }
}
