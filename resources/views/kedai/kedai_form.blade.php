@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form tambah data Produk</h3>
                    </div>
                    <form action="{{ route('kedai.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_kedai">Nama Kedai</label>
                                <input type="text" id="nama_kedai" name="nama_kedai" class="form-control" autofocus>
                                <span class="text-danger">{{ $errors->first('nama_kedai') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control">
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="hari_buka">Hari Buka</label>
                                <select id="hari_buka" name="hari_buka" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                                <label for="hari_tutup">Hari Tutup</label>
                                <select id="hari_tutup" name="hari_tutup" class="form-control"
                                    style="display: inline-block; width: 20%;">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('hari_buka') }}</span>
                                <span class="text-danger">{{ $errors->first('hari_tutup') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" id="jam_buka" name="jam_buka" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" id="jam_tutup" name="jam_tutup" class="form-control"
                                    style="display: inline-block; width: 20%;">
                                <span class="text-danger">{{ $errors->first('jam_buka') }}</span>
                                <span class="text-danger">{{ $errors->first('jam_tutup') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="no_telp">Nomor Telepon</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control">
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="credit_gambar">Credit Gambar</label>
                                <input type="text" id="credit_gambar" name="credit_gambar" class="form-control">
                                <span class="text-danger">{{ $errors->first('credit_gambar') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                {{-- {!! Form::file('gambar', ['class' => 'form-control']) !!} --}}
                                <input type="file" id="gambar" name="gambar[]" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('gambar.*') }}</span>

                                <div id="previewImages"></div>

                                {{-- <button type="button" id="addImageBtn" class="btn btn-primary">Tambah Gambar</button> --}}
                            </div>

                            <label for="optional">Optional Data</label>
                            <div class="form-group">
                                <label for="hari_buka_lainnya">Hari Buka Lainnya</label>
                                <select id="hari_buka_lainnya" name="hari_buka_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                    <option value="">Masukkan Hari Buka Lainnya (Optional)</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                                <label for="hari_tutup_lainnya">Hari Tutup Lainnya</label>
                                <select id="hari_tutup_lainnya" name="hari_tutup_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%;">
                                    <option value="">Masukkan Hari Tutup Lainnya (Optional)</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('hari_buka_lainnya') }}</span>
                                <span class="text-danger">{{ $errors->first('hari_tutup_lainnya') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="jam_buka_lainnya">Jam Buka Lainnya</label>
                                <input type="time" id="jam_buka_lainnya" name="jam_buka_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                <label for="jam_tutup_lainnya">Jam Tutup Lainnya</label>
                                <input type="time" id="jam_tutup_lainnya" name="jam_tutup_lainnya"
                                    class="form-control" style="display: inline-block; width: 20%;">
                                <span class="text-danger">{{ $errors->first('jam_buka_lainnya') }}</span>
                                <span class="text-danger">{{ $errors->first('jam_tutup_lainnya') }}</span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection
