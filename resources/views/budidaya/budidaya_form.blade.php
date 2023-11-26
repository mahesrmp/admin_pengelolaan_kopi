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
                    {{-- {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true, 'enctype' => 'multipart/form-data']) !!} --}}
                    <form action="{{ route('budidaya.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tahapan">Tahapan</label>
                                {{-- {!! Form::text('tahapan', null, ['class' => 'form-control', 'autofocus']) !!} --}}
                                <input type="text" id="tahapan" name="tahapan" class="form-control" autofocus>
                                <span class="text-danger">{{ $errors->first('tahapan') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                {{-- {!! Form::textarea('deskripsi', null, ['class' => 'form-control']) !!} --}}
                                <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                                <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                {{-- {!! Form::text('link', null, ['class' => 'form-control']) !!} --}}
                                <input type="text" id="link" name="link" class="form-control">
                                <span class="text-danger">{{ $errors->first('link') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="sumber_artikel">Sumber Artikel</label>
                                {{-- {!! Form::text('sumber_artikel', null, ['class' => 'form-control']) !!} --}}
                                <input type="text" id="sumber_artikel" name="sumber_artikel" class="form-control">
                                <span class="text-danger">{{ $errors->first('sumber_artikel') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="credit_gambar">Credit Gambar</label>
                                {{-- {!! Form::text('credit_gambar', null, ['class' => 'form-control']) !!} --}}
                                <input type="text" id="credit_gambar" name="credit_gambar" class="form-control">
                                <span class="text-danger">{{ $errors->first('credit_gambar') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                {{-- {!! Form::file('gambar', ['class' => 'form-control']) !!} --}}
                                <input type="file" id="gambar" name="gambar[]" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('gambar.*') }}</span>
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