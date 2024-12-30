<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelGuru;
use App\Models\ModelAlternatif;
use App\Models\ModelDesimal;
use App\Models\ModelKriteria;
use App\Models\ModelPenilaian;
use App\Models\ModelUtility;

class Alternatif extends Controller
{
    public function index()
    {
        $data_alternatif = new ModelAlternatif();

        $data = [
            'tambah' => "admin-alternatif-tambah",
            'ubah' => "admin-alternatif-ubah",
            'hapus' => "admin-alternatif-hapus",
            'profile' => 'admin-profile',
            'halaman' => 'alternatif',
            'logout' => 'logout',
            'alternatif' => $data_alternatif->getNameByIdAll(),
        ];

        return view('admin/alternatif/alternatif', $data);
    }

    public function index_tambah()
    {
        $data_guru = new ModelGuru();

        $data = [
            'kembali' => "admin-alternatif",
            'profile' => 'admin-profile',
            'halaman' => 'alternatif',
            'logout' => 'logout',
            'guru' => $data_guru->getAll(),
        ];

        return view('admin/alternatif/tambah_alternatif', $data);
    }

    public function tambah(Request $request)
    {
        $data_alternatif = new ModelAlternatif();
        $data_kriteria = new ModelKriteria();
        $data_guru = new ModelGuru();

        $alternatif = $data_alternatif->getAll();
        $kriteria = $data_kriteria->getAll();
        $id_guru = $data_guru->getIdByName($request->nama);

        $id_akun = session()->get('id_akun');

        if (count($kriteria) < 5 || count($kriteria) > 5) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 5 Data Kriteria !!',
                'title' => 'Data Kriteria',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-kriteria');
        }

        $request->validate([
            'nama' => 'required',
            'rencana_pelaksanaan_pembelajaran' => 'required|integer',
            'kriteria_ketuntasan_minimal' => 'required|integer',
            'pembuatan_soal' => 'required|integer',
            'absensi_kehadiran' => 'required|integer',
            'ketepatan_waktu' => 'required|integer',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'rencana_pelaksanaan_pembelajaran.required' => 'Rencana Pelaksanaan Pembelajaran harus diisi.',
            'rencana_pelaksanaan_pembelajaran.integer' => 'Rencana Pelaksanaan Pembelajaran harus berupa angka bilangan bulat.',
            'rencana_pelaksanaan_pembelajaran.digits' => 'Rencana Pelaksanaan Pembelajaran harus memiliki 1 digit.',
            'kriteria_ketuntasan_minimal.required' => 'Kriteria Ketuntasan Minimal harus diisi.',
            'kriteria_ketuntasan_minimal.integer' => 'Kriteria Ketuntasan Minimal harus berupa angka bilangan bulat.',
            'kriteria_ketuntasan_minimal.digits' => 'Kriteria Ketuntasan Minimal harus memiliki 1 digit.',
            'pembuatan_soal.required' => 'Pembuatan Soal harus diisi.',
            'pembuatan_soal.integer' => 'Pembuatan Soal harus berupa angka bilangan bulat.',
            'pembuatan_soal.digits' => 'Pembuatan Soal harus memiliki 1 digit.',
            'absensi_kehadiran.required' => 'Absensi Kehadiran harus diisi.',
            'absensi_kehadiran.integer' => 'Absensi Kehadiran harus berupa angka bilangan bulat.',
            'absensi_kehadiran.digits' => 'Absensi Kehadiran harus memiliki 1 digit.',
            'ketepatan_waktu.required' => 'Ketepatan Waktu harus diisi.',
            'ketepatan_waktu.integer' => 'Ketepatan Waktu harus berupa angka bilangan bulat.',
            'ketepatan_waktu.digits' => 'Ketepatan Waktu harus memiliki 1 digit.',
        ]);

        $data = [
            'id_akun' => $id_akun,
            'id_guru' => $id_guru,
            'rencana_pelaksanaan_pembelajaran' => $request->rencana_pelaksanaan_pembelajaran,
            'kriteria_ketuntasan_minimal' => $request->kriteria_ketuntasan_minimal,
            'pembuatan_soal' => $request->pembuatan_soal,
            'absensi_kehadiran' => $request->absensi_kehadiran,
            'ketepatan_waktu' => $request->ketepatan_waktu,
        ];
        $data_alternatif->tambah($data);

        if (count($alternatif) < 2) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 2 Data Alternatif !!',
                'title' => 'Data Alternatif',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-alternatif');
        }

        $data_flash = [
            'icon' => 'fas fa-check',
            'state' => 'success',
            'message' => 'Data Berhasil Ditambah !!',
            'title' => 'Tambah Data',
        ];
        session()->flash('data_flash', $data_flash);

        $this->desimal();

        return redirect()->to('admin-alternatif');
    }

    public function index_ubah($id)
    {
        $data_alternatif = new ModelAlternatif();
        $data_guru = new ModelGuru();

        $alternatif = $data_alternatif->getById($id);

        $data = [
            "kembali" => "/admin-alternatif",
            'profile' => '/admin-profile',
            'halaman' => 'alternatif',
            'logout' => '/logout',
            'guru' => $data_guru->getAll(),
            "alternatif" => $data_alternatif->getNameById($alternatif->id_guru),
        ];

        return view('admin/alternatif/ubah_alternatif', $data);
    }

    public function ubah(Request $request, $id)
    {
        $data_alternatif = new ModelAlternatif();
        $data_kriteria = new ModelKriteria();
        $data_guru = new ModelGuru();

        $alternatif = $data_alternatif->getAll();
        $kriteria = $data_kriteria->getAll();
        $guru = $data_guru->getByName($request->nama);
        $id_guru = $data_guru->getIdByName($request->nama);

        $id_akun = session()->get('id_akun');

        if (count($kriteria) < 5 || count($kriteria) > 5) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 5 Data Kriteria !!',
                'title' => 'Data Kriteria',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-kriteria');
        }

        if ($guru['nama'] == $request->nama) {
            $request->validate([
                'nama' => 'required',
                'rencana_pelaksanaan_pembelajaran' => 'required|integer',
                'kriteria_ketuntasan_minimal' => 'required|integer',
                'pembuatan_soal' => 'required|integer',
                'absensi_kehadiran' => 'required|integer',
                'ketepatan_waktu' => 'required|integer',
            ], [
                'nama.required' => 'Nama harus diisi.',
                'rencana_pelaksanaan_pembelajaran.required' => 'Rencana Pelaksanaan Pembelajaran harus diisi.',
                'rencana_pelaksanaan_pembelajaran.integer' => 'Rencana Pelaksanaan Pembelajaran harus berupa angka bilangan bulat.',
                'rencana_pelaksanaan_pembelajaran.digits' => 'Rencana Pelaksanaan Pembelajaran harus memiliki 1 digit.',
                'kriteria_ketuntasan_minimal.required' => 'Kriteria Ketuntasan Minimal harus diisi.',
                'kriteria_ketuntasan_minimal.integer' => 'Kriteria Ketuntasan Minimal harus berupa angka bilangan bulat.',
                'kriteria_ketuntasan_minimal.digits' => 'Kriteria Ketuntasan Minimal harus memiliki 1 digit.',
                'pembuatan_soal.required' => 'Pembuatan Soal harus diisi.',
                'pembuatan_soal.integer' => 'Pembuatan Soal harus berupa angka bilangan bulat.',
                'pembuatan_soal.digits' => 'Pembuatan Soal harus memiliki 1 digit.',
                'absensi_kehadiran.required' => 'Absensi Kehadiran harus diisi.',
                'absensi_kehadiran.integer' => 'Absensi Kehadiran harus berupa angka bilangan bulat.',
                'absensi_kehadiran.digits' => 'Absensi Kehadiran harus memiliki 1 digit.',
                'ketepatan_waktu.required' => 'Ketepatan Waktu harus diisi.',
                'ketepatan_waktu.integer' => 'Ketepatan Waktu harus berupa angka bilangan bulat.',
                'ketepatan_waktu.digits' => 'Ketepatan Waktu harus memiliki 1 digit.',
            ]);
        } else {
            $request->validate([
                'nama' => 'required',
                'rencana_pelaksanaan_pembelajaran' => 'required|integer',
                'kriteria_ketuntasan_minimal' => 'required|integer',
                'pembuatan_soal' => 'required|integer',
                'absensi_kehadiran' => 'required|integer',
                'ketepatan_waktu' => 'required|integer',
            ], [
                'nama.required' => 'Nama harus diisi.',
                'rencana_pelaksanaan_pembelajaran.required' => 'Rencana Pelaksanaan Pembelajaran harus diisi.',
                'rencana_pelaksanaan_pembelajaran.integer' => 'Rencana Pelaksanaan Pembelajaran harus berupa angka bilangan bulat.',
                'rencana_pelaksanaan_pembelajaran.digits' => 'Rencana Pelaksanaan Pembelajaran harus memiliki 1 digit.',
                'kriteria_ketuntasan_minimal.required' => 'Kriteria Ketuntasan Minimal harus diisi.',
                'kriteria_ketuntasan_minimal.integer' => 'Kriteria Ketuntasan Minimal harus berupa angka bilangan bulat.',
                'kriteria_ketuntasan_minimal.digits' => 'Kriteria Ketuntasan Minimal harus memiliki 1 digit.',
                'pembuatan_soal.required' => 'Pembuatan Soal harus diisi.',
                'pembuatan_soal.integer' => 'Pembuatan Soal harus berupa angka bilangan bulat.',
                'pembuatan_soal.digits' => 'Pembuatan Soal harus memiliki 1 digit.',
                'absensi_kehadiran.required' => 'Absensi Kehadiran harus diisi.',
                'absensi_kehadiran.integer' => 'Absensi Kehadiran harus berupa angka bilangan bulat.',
                'absensi_kehadiran.digits' => 'Absensi Kehadiran harus memiliki 1 digit.',
                'ketepatan_waktu.required' => 'Ketepatan Waktu harus diisi.',
                'ketepatan_waktu.integer' => 'Ketepatan Waktu harus berupa angka bilangan bulat.',
                'ketepatan_waktu.digits' => 'Ketepatan Waktu harus memiliki 1 digit.',
            ]);
        }

        $data = [
            'id_alternatif' => $id,
            'id_akun' => $id_akun,
            'id_guru' => $id_guru,
            'rencana_pelaksanaan_pembelajaran' => $request->rencana_pelaksanaan_pembelajaran,
            'kriteria_ketuntasan_minimal' => $request->kriteria_ketuntasan_minimal,
            'pembuatan_soal' => $request->pembuatan_soal,
            'absensi_kehadiran' => $request->absensi_kehadiran,
            'ketepatan_waktu' => $request->ketepatan_waktu,
        ];
        $data_alternatif->ubah($id, $data);

        if (count($alternatif) < 2) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 2 Data Alternatif !!',
                'title' => 'Data Alternatif',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-alternatif');
        }

        $data_flash = [
            'icon' => 'fas fa-check',
            'state' => 'success',
            'message' => 'Data Berhasil Diubah !!',
            'title' => 'Ubah Data',
        ];
        session()->flash('data_flash', $data_flash);

        $this->desimal();

        return redirect()->to('admin-alternatif');
    }

    public function hapus($id)
    {
        $data_alternatif = new ModelAlternatif();
        $data_kriteria = new ModelKriteria();

        $alternatif = $data_alternatif->getAll();
        $kriteria = $data_kriteria->getAll();

        if (count($kriteria) < 5 || count($kriteria) > 5) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 5 Data Kriteria !!',
                'title' => 'Data Kriteria',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-kriteria');
        }

        if (count($alternatif) < 3) {
            $data_flash = [
                'icon' => 'fas fa-times',
                'state' => 'danger',
                'message' => 'Harus 2 Data Alternatif !!',
                'title' => 'Data Alternatif',
            ];
            session()->flash('data_flash', $data_flash);

            return redirect()->to('admin-alternatif');
        }

        $data_alternatif->hapus($id);

        $data_flash = [
            'icon' => 'fas fa-check',
            'state' => 'success',
            'message' => 'Data Berhasil Dihapus !!',
            'title' => 'Hapus Data',
        ];
        session()->flash('data_flash', $data_flash);

        return redirect()->to('admin-alternatif');
    }

    public function desimal()
    {
        $data_alternatif = new ModelAlternatif();
        $alternatif = $data_alternatif->getAll();
        $alternatif_array = $alternatif->toArray();

        $nilai_desimal = array();
        foreach ($alternatif_array as $index => $key) {
            foreach ($key as $variable => $value) {
                if ($variable == 'id_alternatif') {
                    $nilai_desimal[$index][$variable] = $value;
                } elseif ($variable == 'id_akun') {
                    $nilai_desimal[$index][$variable] = $value;
                } elseif ($variable == 'id_guru') {
                    $nilai_desimal[$index][$variable] = $value;
                } elseif ($variable == 'created_at') {
                    $nilai_desimal[$index][$variable] = $value;
                } elseif ($variable == 'updated_at') {
                    $nilai_desimal[$index][$variable] = $value;
                } else {
                    $nilai_desimal[$index][$variable] = (int)$value * 0.01;
                }
            }
        }

        $data_desimal = new ModelDesimal();
        for ($i = 0; $i < count($alternatif_array); $i++) {
            $data = [
                'id_desimal' => $nilai_desimal[$i]['id_alternatif'],
                'id_alternatif' => $nilai_desimal[$i]['id_alternatif'],
                'id_guru' => $nilai_desimal[$i]['id_guru'],
                'rencana_pelaksanaan_pembelajaran' => $nilai_desimal[$i]['rencana_pelaksanaan_pembelajaran'],
                'kriteria_ketuntasan_minimal' => $nilai_desimal[$i]['kriteria_ketuntasan_minimal'],
                'pembuatan_soal' => $nilai_desimal[$i]['pembuatan_soal'],
                'absensi_kehadiran' => $nilai_desimal[$i]['absensi_kehadiran'],
                'ketepatan_waktu' => $nilai_desimal[$i]['ketepatan_waktu'],
            ];

            $cek = count($data_desimal->cekData($data));
            if ($cek > 0) {
                $data_desimal->ubah($nilai_desimal[$i]['id_alternatif'], $data);
            } else {
                $data_desimal->tambah($data);
            }
        }

        $this->utility();
    }

    public function utility()
    {
        $data_desimal = new ModelDesimal();
        $desimal = $data_desimal->getAll();
        $desimal_array = $desimal->toArray();

        $dataMin = [
            $data_desimal->getMin('rencana_pelaksanaan_pembelajaran'),
            $data_desimal->getMin('kriteria_ketuntasan_minimal'),
            $data_desimal->getMin('pembuatan_soal'),
            $data_desimal->getMin('absensi_kehadiran'),
            $data_desimal->getMin('ketepatan_waktu'),
        ];

        $dataMax = [
            $data_desimal->getMax('rencana_pelaksanaan_pembelajaran'),
            $data_desimal->getMax('kriteria_ketuntasan_minimal'),
            $data_desimal->getMax('pembuatan_soal'),
            $data_desimal->getMax('absensi_kehadiran'),
            $data_desimal->getMax('ketepatan_waktu'),
        ];

        $nilai_utility = array();
        foreach ($desimal_array as $index => $key) {
            foreach ($key as $variable => $value) {
                if ($variable == 'rencana_pelaksanaan_pembelajaran') {
                    $nilai_utility[$index][$variable] = (((float)$value - (float)$dataMin[0]) / ((float)$dataMax[0] - (float)$dataMin[0])) * 100 / 100;
                } elseif ($variable == 'kriteria_ketuntasan_minimal') {
                    $nilai_utility[$index][$variable] = (((float)$value - (float)$dataMin[1]) / ((float)$dataMax[1] - (float)$dataMin[1])) * 100 / 100;
                } elseif ($variable == 'pembuatan_soal') {
                    $nilai_utility[$index][$variable] = (((float)$value - (float)$dataMin[2]) / ((float)$dataMax[2] - (float)$dataMin[2])) * 100 / 100;
                } elseif ($variable == 'absensi_kehadiran') {
                    $nilai_utility[$index][$variable] = (((float)$dataMax[3] - (float)$value) / ((float)$dataMax[3] - (float)$dataMin[3])) * 100 / 100;
                } elseif ($variable == 'ketepatan_waktu') {
                    $nilai_utility[$index][$variable] = (((float)$dataMax[4] - (float)$value) / ((float)$dataMax[4] - (float)$dataMin[4])) * 100 / 100;
                } else {
                    $nilai_utility[$index][$variable] = $value;
                }
            }
        }

        $data_utility = new ModelUtility();
        for ($i = 0; $i < count($nilai_utility); $i++) {
            $data = [
                'id_utility' => $nilai_utility[$i]['id_alternatif'],
                'id_alternatif' => $nilai_utility[$i]['id_alternatif'],
                'id_guru' => $nilai_utility[$i]['id_guru'],
                'rencana_pelaksanaan_pembelajaran' => $nilai_utility[$i]['rencana_pelaksanaan_pembelajaran'],
                'kriteria_ketuntasan_minimal' => $nilai_utility[$i]['kriteria_ketuntasan_minimal'],
                'pembuatan_soal' => $nilai_utility[$i]['pembuatan_soal'],
                'absensi_kehadiran' => $nilai_utility[$i]['absensi_kehadiran'],
                'ketepatan_waktu' => $nilai_utility[$i]['ketepatan_waktu'],
            ];

            $cek = count($data_utility->cekData($data));
            if ($cek > 0) {
                $data_utility->ubah($nilai_utility[$i]['id_alternatif'], $data);
            } else {
                $data_utility->tambah($data);
            }
        }

        $this->penilaian();
    }

    public function penilaian()
    {
        $data_utility = new ModelUtility();
        $utility = $data_utility->getAll();
        $utility_array = $utility->toArray();

        $data_kriteria = new ModelKriteria();
        $kriteria = $data_kriteria->getAll();
        $kriteria_array = $kriteria->toArray();

        $nilai_penilaian = array();
        foreach ($utility_array as $index => $key) {
            foreach ($key as $variable => $value) {
                if ($variable == 'rencana_pelaksanaan_pembelajaran') {
                    $nilai_penilaian[$index][$variable] = (float)$value * (float)((int)$kriteria_array[0]['bobot'] / 100);
                } elseif ($variable == 'kriteria_ketuntasan_minimal') {
                    $nilai_penilaian[$index][$variable] = (float)$value * (float)((int)$kriteria_array[1]['bobot'] / 100);
                } elseif ($variable == 'pembuatan_soal') {
                    $nilai_penilaian[$index][$variable] = (float)$value * (float)((int)$kriteria_array[2]['bobot'] / 100);
                } elseif ($variable == 'absensi_kehadiran') {
                    $nilai_penilaian[$index][$variable] = (float)$value * (float)((int)$kriteria_array[3]['bobot'] / 100);
                } elseif ($variable == 'ketepatan_waktu') {
                    $nilai_penilaian[$index][$variable] = (float)$value * (float)((int)$kriteria_array[4]['bobot'] / 100);
                } else {
                    $nilai_penilaian[$index][$variable] = $value;
                }
            }
        }

        $tambah_nilai_hasil = array();
        foreach ($nilai_penilaian as $index => $member) {
            $hasil = 0;
            foreach ($member as $name => $age) {
                if ($name == "id_utility") {
                    (int)$age;
                } elseif ($name == "id_alternatif") {
                    (int)$age;
                } elseif ($name == "id_guru") {
                    (int)$age;
                } elseif ($name == "created_at") {
                    (int)$age;
                } elseif ($name == "updated_at") {
                    (int)$age;
                } else {
                    $hasil += (float)$age;
                }
            }
            $tambah_nilai_hasil[] = $hasil;
        }

        $v = 0;
        $rank_nilai = array();
        foreach ($nilai_penilaian as $index => $member) {
            foreach ($member as $name => $age) {
                if ($name == 'ketepatan_waktu') {
                    $rank_nilai[$index]['id_penilaian'] = (int)$nilai_penilaian[$index]['id_alternatif'];
                    $rank_nilai[$index]['id_alternatif'] = (int)$nilai_penilaian[$index]['id_alternatif'];
                    $rank_nilai[$index]['id_guru'] = (int)$nilai_penilaian[$index]['id_guru'];
                    $rank_nilai[$index]['rencana_pelaksanaan_pembelajaran'] = (float)$nilai_penilaian[$index]['rencana_pelaksanaan_pembelajaran'];
                    $rank_nilai[$index]['kriteria_ketuntasan_minimal'] = (float)$nilai_penilaian[$index]['kriteria_ketuntasan_minimal'];
                    $rank_nilai[$index]['pembuatan_soal'] = (float)$nilai_penilaian[$index]['pembuatan_soal'];
                    $rank_nilai[$index]['absensi_kehadiran'] = (float)$nilai_penilaian[$index]['absensi_kehadiran'];
                    $rank_nilai[$index]['ketepatan_waktu'] = (float)$nilai_penilaian[$index]['ketepatan_waktu'];
                    $rank_nilai[$index]['nilai'] = (float)$tambah_nilai_hasil[$v];
                    $v++;
                }
            }
        }

        usort($rank_nilai, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        $data_perangkingan = new ModelPenilaian();

        $x = 0;
        $y = 1;
        $perangkingan = array();
        foreach ($rank_nilai as $index => $member) {
            foreach ($member as $name => $age) {
                if ($name == 'nilai') {
                    $rank_nilai[$index]['id_penilaian'] = (int)$nilai_penilaian[$index]['id_alternatif'];
                    $rank_nilai[$index]['id_alternatif'] = (int)$nilai_penilaian[$index]['id_alternatif'];
                    $rank_nilai[$index]['id_guru'] = (int)$nilai_penilaian[$index]['id_guru'];
                    $rank_nilai[$index]['rencana_pelaksanaan_pembelajaran'] = (float)$nilai_penilaian[$index]['rencana_pelaksanaan_pembelajaran'];
                    $rank_nilai[$index]['kriteria_ketuntasan_minimal'] = (float)$nilai_penilaian[$index]['kriteria_ketuntasan_minimal'];
                    $rank_nilai[$index]['pembuatan_soal'] = (float)$nilai_penilaian[$index]['pembuatan_soal'];
                    $rank_nilai[$index]['absensi_kehadiran'] = (float)$nilai_penilaian[$index]['absensi_kehadiran'];
                    $rank_nilai[$index]['ketepatan_waktu'] = (float)$nilai_penilaian[$index]['ketepatan_waktu'];
                    $rank_nilai[$index]['nilai'] = (float)$rank_nilai[$index]['nilai'];
                    $perangkingan[$index]['rank'] = $y;

                    $data = [
                        'id_penilaian' => $nilai_penilaian[$x]['id_alternatif'],
                        'id_alternatif' => $nilai_penilaian[$x]['id_alternatif'],
                        'id_guru' => $nilai_penilaian[$x]['id_guru'],
                        'rencana_pelaksanaan_pembelajaran' => $nilai_penilaian[$x]['rencana_pelaksanaan_pembelajaran'],
                        'kriteria_ketuntasan_minimal' => $nilai_penilaian[$x]['kriteria_ketuntasan_minimal'],
                        'pembuatan_soal' => $nilai_penilaian[$x]['pembuatan_soal'],
                        'absensi_kehadiran' => $nilai_penilaian[$x]['absensi_kehadiran'],
                        'ketepatan_waktu' => $nilai_penilaian[$x]['ketepatan_waktu'],
                        'nilai' => (float)$rank_nilai[$x]['nilai'],
                        'rank' => $y,
                    ];

                    $cek = count($data_perangkingan->cekData($data));
                    if ($cek > 0) {
                        $data_perangkingan->ubah($rank_nilai[$x]['id_alternatif'], $data);
                    } else {
                        $data_perangkingan->tambah($data);
                    }
                    $x++;
                    $y++;
                }
            }
        }
    }
}
