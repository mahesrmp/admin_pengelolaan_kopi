@extends('layouts.admin')

@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
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
                        @foreach ($budidayas->groupBy('kategori') as $kategori => $items)
                            <h2>{{ $kategori }}</h2>
                            @foreach ($items as $budidaya)
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title budidaya-tahapan">
                                                <a href="{{ route('budidaya.show', $budidaya['id']) }}">
                                                    {{ $budidaya['tahapan'] }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
        // Tambahkan script SweetAlert2 di sini
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
