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
                        <h3 class="card-title">Form tambah data Kedai Kopi</h3>
                    </div>
                    <form id="gambar-form" action="{{ route('kedai.update', $kedai['id']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_kedai">Nama Kedai</label>
                                <input type="text" id="nama_kedai" name="nama_kedai" class="form-control"
                                    value="{{ $kedai->nama_kedai }}">
                                <span class="text-danger">{{ $errors->first('nama_kedai') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    value="{{ $kedai->alamat }}">
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="hari_buka">Hari Buka</label>
                                <select id="hari_buka" name="hari_buka" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                    <option value="Senin"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Senin' ? 'selected' : '' }}>Senin
                                    </option>
                                    <option value="Selasa"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Selasa' ? 'selected' : '' }}>Selasa
                                    </option>
                                    <option value="Rabu"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Kamis' ? 'selected' : '' }}>Kamis
                                    </option>
                                    <option value="Jumat"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Jumat' ? 'selected' : '' }}>Jumat
                                    </option>
                                    <option value="Sabtu"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                    </option>
                                    <option value="Minggu"
                                        {{ old('hari_buka', $kedai->hari_buka) == 'Minggu' ? 'selected' : '' }}>Minggu
                                    </option>
                                </select>

                                <label for="hari_tutup">Hari Tutup</label>
                                <select id="hari_tutup" name="hari_tutup" class="form-control"
                                    style="display: inline-block; width: 20%;">
                                    <option value="Senin"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Senin' ? 'selected' : '' }}>Senin
                                    </option>
                                    <option value="Selasa"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Selasa' ? 'selected' : '' }}>Selasa
                                    </option>
                                    <option value="Rabu"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Rabu' ? 'selected' : '' }}>Rabu
                                    </option>
                                    <option value="Kamis"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Kamis' ? 'selected' : '' }}>Kamis
                                    </option>
                                    <option value="Jumat"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Jumat' ? 'selected' : '' }}>Jumat
                                    </option>
                                    <option value="Sabtu"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Sabtu' ? 'selected' : '' }}>Sabtu
                                    </option>
                                    <option value="Minggu"
                                        {{ old('hari_tutup', $kedai->hari_tutup) == 'Minggu' ? 'selected' : '' }}>Minggu
                                    </option>
                                </select>

                                <span class="text-danger">{{ $errors->first('hari_buka') }}</span>
                                <span class="text-danger">{{ $errors->first('hari_tutup') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" id="jam_buka" name="jam_buka" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;"
                                    value="{{ old('jam_buka', isset($kedai) ? $kedai->jam_buka : '') }}">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" id="jam_tutup" name="jam_tutup" class="form-control"
                                    style="display: inline-block; width: 20%;"
                                    value="{{ old('jam_tutup', isset($kedai) ? $kedai->jam_tutup : '') }}">
                                <span class="text-danger">{{ $errors->first('jam_buka') }}</span>
                                <span class="text-danger">{{ $errors->first('jam_tutup') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="no_telp">Nomor Telepon</label>
                                <input type="text" id="no_telp" name="no_telp" class="form-control"
                                    value="{{ old('no_telp', isset($kedai) ? $kedai->no_telp : '') }}">
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="credit_gambar">Credit Gambar</label>
                                <input type="text" id="credit_gambar" name="credit_gambar" class="form-control"
                                    value="{{ old('credit_gambar', isset($kedai) ? $kedai->credit_gambar : '') }}">
                                <span class="text-danger">{{ $errors->first('credit_gambar') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" id="gambar" name="gambar[]" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('gambar.*') }}</span>

                                <div id="previewImages">
                                    @foreach ($kedai->images as $image)
                                        <div class="image-preview">
                                            <img src="{{ asset('storage/' . $image->gambar) }}" alt="Image">
                                            <button type="button" class="remove-image"
                                                data-image-id="{{ $image->id }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="deletedImages"></div>
                            </div>

                            <label for="optional">Optional Data</label>
                            <div class="form-group">
                                <label for="hari_buka_lainnya">Hari Buka Lainnya</label>
                                <select id="hari_buka_lainnya" name="hari_buka_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;">
                                    <option value="">-</option>
                                    <option value="Senin"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Senin' ? 'selected' : '' }}>
                                        Senin
                                    </option>
                                    <option value="Selasa"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Selasa' ? 'selected' : '' }}>
                                        Selasa
                                    </option>
                                    <option value="Rabu"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Rabu' ? 'selected' : '' }}>
                                        Rabu</option>
                                    <option value="Kamis"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Kamis' ? 'selected' : '' }}>
                                        Kamis
                                    </option>
                                    <option value="Jumat"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Jumat' ? 'selected' : '' }}>
                                        Jumat
                                    </option>
                                    <option value="Sabtu"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Sabtu' ? 'selected' : '' }}>
                                        Sabtu
                                    </option>
                                    <option value="Minggu"
                                        {{ old('hari_buka_lainnya', $kedai->hari_buka_lainnya) == 'Minggu' ? 'selected' : '' }}>
                                        Minggu
                                    </option>
                                </select>
                                <label for="hari_tutup_lainnya">Hari Tutup Lainnya</label>
                                <select id="hari_tutup_lainnya" name="hari_tutup_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%;">
                                    <option value="">-</option>
                                    <option value="Senin"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Senin' ? 'selected' : '' }}>
                                        Senin
                                    </option>
                                    <option value="Selasa"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Selasa' ? 'selected' : '' }}>
                                        Selasa
                                    </option>
                                    <option value="Rabu"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Rabu' ? 'selected' : '' }}>
                                        Rabu</option>
                                    <option value="Kamis"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Kamis' ? 'selected' : '' }}>
                                        Kamis
                                    </option>
                                    <option value="Jumat"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Jumat' ? 'selected' : '' }}>
                                        Jumat
                                    </option>
                                    <option value="Sabtu"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Sabtu' ? 'selected' : '' }}>
                                        Sabtu
                                    </option>
                                    <option value="Minggu"
                                        {{ old('hari_tutup_lainnya', $kedai->hari_tutup_lainnya) == 'Minggu' ? 'selected' : '' }}>
                                        Minggu
                                    </option>
                                </select>
                                <span class="text-danger">{{ $errors->first('hari_buka_lainnya') }}</span>
                                <span class="text-danger">{{ $errors->first('hari_tutup_lainnya') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="jam_buka_lainnya">Jam Buka Lainnya</label>
                                <input type="time" id="jam_buka_lainnya" name="jam_buka_lainnya" class="form-control"
                                    style="display: inline-block; width: 20%; margin-right: 2%;"
                                    value="{{ old('jam_buka_lainnya', isset($kedai) ? $kedai->jam_buka_lainnya : '') }}">
                                <label for="jam_tutup_lainnya">Jam Tutup Lainnya</label>
                                <input type="time" id="jam_tutup_lainnya" name="jam_tutup_lainnya"
                                    class="form-control" style="display: inline-block; width: 20%;"
                                    value="{{ old('jam_tutup_lainnya', isset($kedai) ? $kedai->jam_tutup_lainnya : '') }}">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Remove image preview and set hidden input for deletion
        $(document).on('click', '.remove-image', function() {
            var imageId = $(this).data('image-id');
            $(this).parent('.image-preview').remove();

            // Add a hidden input to track the images to delete
            $('<input>').attr({
                type: 'hidden',
                name: 'delete_images[]',
                value: imageId
            }).appendTo('#deletedImages');
        });

        // Preview selected images
        $('#gambar').on('change', function() {
            var previewImages = $('#previewImages');
            previewImages.empty();

            var input = $(this)[0];
            if (input.files && input.files.length) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imagePreview = '<div class="image-preview"><img src="' + e.target.result +
                            '" alt="Image"></div>';
                        previewImages.append(imagePreview);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        });
    </script>
@endsection
