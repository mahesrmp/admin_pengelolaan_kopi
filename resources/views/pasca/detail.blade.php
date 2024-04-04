@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $pasca->kategori }}</h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h5 class="card-title">Deskripsi:</h5>
                        <p class="card-text mt-2">{{ $pasca->deskripsi }}</p>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Sumber Artikel:</h5>
                        <p class="card-text mt-2">{{ $pasca->sumber_artikel }}</p>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Link Video:</h5>
                        <p class="card-text mt-2">
                            <a href="{{ $pasca->link }}">{{ $pasca->link }}</a>
                        </p>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Gambar</h5>
                        <div id="carouselExampleIndicators{{ $pasca->id }}" class="carousel slide"
                            data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @php
                                    $gambarCount = count($pasca->images); // Menghitung jumlah gambar dari data yang diterima
                                @endphp
                                @for ($i = 0; $i < $gambarCount; $i++)
                                    <button type="button" data-bs-target="#carouselExampleIndicators{{ $pasca->id }}"
                                        data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $i + 1 }}"></button>
                                @endfor
                            </div>
                            <div class="carousel-inner">
                                @foreach ($pasca->images as $key => $image)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image->gambar) }}"
                                            style="width: 100%; height: 500px;" alt="...">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators{{ $pasca->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators{{ $pasca->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Credit Gambar</h5>
                        <p class="card-text mt-2">{{ $pasca->credit_gambar }}</p>
                    </div>
                </div>
            </div><!-- /.card-header -->
        </section>
        <!-- /.Left col -->
    </div>
@endsection
