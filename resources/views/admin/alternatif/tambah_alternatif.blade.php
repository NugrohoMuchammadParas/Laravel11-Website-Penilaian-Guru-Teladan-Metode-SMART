<x-admin>
    <x-slot:profile>{{ $profile }}</x-slot:profile>
    <x-slot:halaman>{{ $halaman }}</x-slot:halaman>
    <x-slot:logout>{{ $logout }}</x-slot:logout>
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Data Alternatif</div>
                        </div>
                        <div class="card-body">
                            <form action="admin-alternatif-tambah-data" method="POST" id="formInput" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @error('nama') has-error has-feedback @enderror">
                                            <label for="nama">Nama :</label>
                                            <select class="form-select form-control" id="nama" name="nama">
                                                <option class="select" disabled>Pilih Data</option>
                                                <?php foreach ($guru as $isi) : ?>
                                                <option value="<?= $isi['nama'] ?>"><?= $isi['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="nama"
                                                class="form-text text-muted @error('nama') text-danger @enderror">
                                                @error('nama')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group @error('rencana_pelaksanaan_pembelajaran') has-error has-feedback @enderror">
                                            <label for="rencana_pelaksanaan_pembelajaran">Rencana Pelaksanaan
                                                Pembelajaran :</label>
                                            <input type="number" name="rencana_pelaksanaan_pembelajaran"
                                                class="form-control" id="rencana_pelaksanaan_pembelajaran"
                                                placeholder="Input Data......" />
                                            <small id="rencana_pelaksanaan_pembelajaran"
                                                class="form-text text-muted @error('rencana_pelaksanaan_pembelajaran') text-danger @enderror">
                                                @error('rencana_pelaksanaan_pembelajaran')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group @error('kriteria_ketuntasan_minimal') has-error has-feedback @enderror">
                                            <label for="kriteria_ketuntasan_minimal">Kriteria Ketuntasan Minimal
                                                :</label>
                                            <input type="number" name="kriteria_ketuntasan_minimal"
                                                class="form-control" id="kriteria_ketuntasan_minimal"
                                                placeholder="Input Data......" />
                                            <small id="kriteria_ketuntasan_minimal"
                                                class="form-text text-muted @error('kriteria_ketuntasan_minimal') text-danger @enderror">
                                                @error('kriteria_ketuntasan_minimal')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group @error('pembuatan_soal') has-error has-feedback @enderror">
                                            <label for="pembuatan_soal">Pembuatan Soal :</label>
                                            <input type="number" name="pembuatan_soal" class="form-control"
                                                id="pembuatan_soal" placeholder="Input Data......" />
                                            <small id="pembuatan_soal"
                                                class="form-text text-muted @error('pembuatan_soal') text-danger @enderror">
                                                @error('pembuatan_soal')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group @error('absensi_kehadiran') has-error has-feedback @enderror">
                                            <label for="absensi_kehadiran">Absensi Kehadiran :</label>
                                            <input type="number" name="absensi_kehadiran" class="form-control"
                                                id="absensi_kehadiran" placeholder="Input Data......" />
                                            <small id="absensi_kehadiran"
                                                class="form-text text-muted @error('absensi_kehadiran') text-danger @enderror">
                                                @error('absensi_kehadiran')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group @error('ketepatan_waktu') has-error has-feedback @enderror">
                                            <label for="ketepatan_waktu">Ketepatan Waktu :</label>
                                            <input type="number" name="ketepatan_waktu" class="form-control"
                                                id="ketepatan_waktu" placeholder="Input Data......" />
                                            <small id="ketepatan_waktu"
                                                class="form-text text-muted @error('ketepatan_waktu') text-danger @enderror">
                                                @error('ketepatan_waktu')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button type="button" class="btn btn-rounded btn-sm btn-black mx-2"
                                            id="kembali" data-pages="<?= $kembali ?>"><i
                                                class="fas fa-arrow-circle-left"></i> Kembali</button>
                                        <button type="button" class="btn btn-rounded btn-sm btn-black mx-2"
                                            id="simpan_tambah"><i class="fas fa-download"></i> Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
