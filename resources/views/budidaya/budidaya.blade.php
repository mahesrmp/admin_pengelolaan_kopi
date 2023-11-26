@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
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

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('budidaya.create') }}">
                        <button type="button" class="btn btn-primary">
                            <h3 class="card-title">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M16 8h3h-3ZM5 8h8.45H13h.35H5Zm.4-2h13.2l-.85-1H6.25L5.4 6Zm4.6 6.75l2-1l2 1V8h-4v4.75ZM14.55 21H5q-.825 0-1.413-.588T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675v4.9q-.475-.175-.975-.275T19 11.05V8h-3v3.825q-.875.5-1.525 1.238t-1.025 1.662L12 14l-4 2V8H5v11h8.35q.2.575.5 1.075t.7.925ZM18 21v-3h-3v-2h3v-3h2v3h3v2h-3v3h-2Z" />
                                    </svg>
                                </i>
                            </h3>
                        </button>
                    </a>

                    <div class="row mt-3">
                        @foreach ($budidayas as $budidaya)
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <strong
                                                class="font-size-lg font-weight-bold">{{ $budidaya['tahapan'] }}</strong>
                                        </h5>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Deskripsi:</h5>
                                        <p class="card-text mt-2">{{ $budidaya['deskripsi'] }}</p>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Sumber Artikel:</h5>
                                        <p class="card-text mt-2">{{ $budidaya['sumber_artikel'] }}</p>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Link Video:</h5>
                                        <p class="card-text mt-2">
                                            <a href="{{ $budidaya['link'] }}">{{ $budidaya['link'] }}</a>
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        {{-- <h5 class="card-title">Gambar:</h5>
                                        <img src="{{ $budidaya['gambar'] }}" class="d-block w-50" alt="gambar_budidaya"> --}}

                                        <h5 class="card-title">Gambar</h5>
                                        <div id="carouselExampleIndicators{{ $budidaya['id'] }}" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                @php
                                                    $gambarCount = count($budidaya['images']); // Menghitung jumlah gambar dari data yang diterima
                                                @endphp
                                                @for ($i = 0; $i < $gambarCount; $i++)
                                                    <button type="button"
                                                        data-bs-target="#carouselExampleIndicators{{ $budidaya['id'] }}"
                                                        data-bs-slide-to="{{ $i }}"
                                                        class="{{ $i === 0 ? 'active' : '' }}"
                                                        aria-label="Slide {{ $i + 1 }}"></button>
                                                @endfor
                                            </div>
                                            <div class="carousel-inner">
                                                @foreach ($budidaya['images'] as $key => $image)
                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                        <img src="{{ $image['gambar'] }}" style="width: 100%; height: 500px;"
                                                            alt="...">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleIndicators{{ $budidaya['id'] }}"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleIndicators{{ $budidaya['id'] }}"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- <div class="card-body">
                                                        <h5 class="card-title">Gambar</h5>
                                                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                            <div class="carousel-indicators">
                                                                @php
                                                                    $gambarCount = count($budidayas); // Menghitung jumlah gambar dari data yang diterima
                                                                @endphp
                                                                @for ($i = 0; $i < $gambarCount; $i++)
                                                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}"
                                                                        class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
                                                                @endfor
                                                            </div>
                                                            <div class="carousel-inner">
                                                                @foreach ($budidayas as $key => $budidaya)
                                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                                        @if (isset($budidaya['gambar']))
                                                                            <img src="{{ $budidaya['gambar'] }}" class="d-block w-100" alt="...">
                                                                        @else
                                                                            <!-- Tampilkan gambar default jika gambar tidak ada -->
                                                                            <img src="{{ asset('template/dist/img/default.jpg') }}" class="d-block w-100" alt="Default">
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    </div> --}}

                                    <div class="card-body">
                                        <h5 class="card-title">Credit Gambar</h5>
                                        <p class="card-text mt-2">{{ $budidaya['credit_gambar'] }}</p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <div class="text-right">
                                            <form id="delete-form-{{ $budidaya['id'] }}"
                                                action="{{ route('budidaya.destroy', $budidaya['id']) }}" method="POST"
                                                class="d-inline delete-about-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete({{ $budidaya['id'] }}, event)"
                                                    class="btn btn-danger btn-sm delete-about">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>
                                            <a href="{{ route('budidaya.edit', $budidaya['id']) }}"
                                                class="btn btn-success btn-sm text-center"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!-- /.card-header -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, event) {
            event.preventDefault(); // Mencegah perilaku formulir default

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
