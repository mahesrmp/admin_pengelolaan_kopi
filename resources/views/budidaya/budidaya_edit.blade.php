@extends('layouts.admin')

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
                    {{-- {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true, 'enctype' => 'multipart/form-data']) !!} --}}
                    <form action="{{ route('budidaya.update', $budidaya['id']) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <input type="text" id="kategori" name="kategori" class="form-control"
                                    value="{{ $budidaya->kategori }}">
                                <span class="text-danger">{{ $errors->first('kategori') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tahapan">Tahapan</label>
                                {{-- {!! Form::text('tahapan', null, ['class' => 'form-control', 'autofocus']) !!} --}}
                                <input type="text" id="tahapan" name="tahapan" class="form-control"
                                    value="{{ $budidaya->tahapan }}">
                                <span class="text-danger">{{ $errors->first('tahapan') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="tahapan">Tahapan</label>
                                {{-- {!! Form::text('tahapan', null, ['class' => 'form-control', 'autofocus']) !!} --}}
                                <input type="text" id="tahapan" name="tahapan" class="form-control"
                                    value="{{ $budidaya->tahapan }}">
                                <span class="text-danger">{{ $errors->first('tahapan') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                {{-- {!! Form::textarea('deskripsi', null, ['class' => 'form-control']) !!} --}}
                                <textarea id="deskripsi" name="deskripsi" class="form-control" value="{{ $budidaya->deskripsi }}">{{ $budidaya->deskripsi }}</textarea>
                                <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                {{-- {!! Form::text('link', null, ['class' => 'form-control']) !!} --}}
                                <input type="text" id="link" name="link" class="form-control"
                                    value="{{ $budidaya->link }}">
                                <span class="text-danger">{{ $errors->first('link') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="credit_gambar">Credit Gambar</label>
                                {{-- {!! Form::text('credit_gambar', null, ['class' => 'form-control']) !!} --}}
                                <input type="text" id="credit_gambar" name="credit_gambar" class="form-control"
                                    value="{{ $budidaya->credit_gambar }}">
                                <span class="text-danger">{{ $errors->first('credit_gambar') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" id="gambar" name="gambar[]" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('gambar.*') }}</span>
                            </div>

                            {{-- <label for="gambar">File input</label>
                        <div>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                            </div>
                        </div>
                        <span class="text-danger">{{ $errors->first('gambar') }}</span> --}}
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
@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
