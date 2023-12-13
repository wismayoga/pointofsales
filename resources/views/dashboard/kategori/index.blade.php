{{-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
@extends('layouts/main')
@section('title', 'Kategori')

@section('content')
    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambah">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="py-2 needs-validation" action="{{ route('kategori.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukan nama..." id="nama"
                                aria-describedby="nama" name="nama" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kategoris as $key => $kategori)
        <!-- Modal Edit-->
        <div class="modal fade" id="modalEdit{{ $kategori->id }}" tabindex="-1"
            aria-labelledby="modalEdit{{ $kategori->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEdit{{ $kategori->id }}">Edit
                            Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="py-2 needs-validation" action="{{ route('kategori.update', $kategori->id) }}"
                        method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama
                                    Kategori</label>
                                <input type="text" class="form-control" placeholder="Masukan nama..."
                                    value="{{ $kategori->nama_kategori }}" id="nama" aria-describedby="nama"
                                    name="nama" required>
                            </div>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="app-content">
        <div class="content-wrapper">
            <div class="">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-style-light absolute " role="alert" style="z-index: 1000;">
                        <span class="alert-icon-wrap mb-3">
                            {{ session('success') }}
                        </span>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-style-light absolute " role="alert" style="z-index: 1000;">
                        <span class="alert-icon-wrap mb-3">
                            {{ session('error') }}
                        </span>
                        <button type="button" class="btn-close float-end" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <div class="page-description">
                            <h1>Daftar Kategori</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalTambah"><i class="material-icons">add</i>Tambah</button>
                                </h5>
                            </div>
                            <div class="card-body">
                                <table id="datatable1" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 900px;">Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoris as $key => $kategori)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $kategori->nama_kategori }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col text-end">
                                                            <button type="button" class="btn btn-warning btn-style-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEdit{{ $kategori->id }}"><i
                                                                    class="material-icons">edit</i>Edit</button>
                                                        </div>
                                                        <div class="col">
                                                            <form onsubmit="return confirm('Yakin Menghapus Kategori?');"
                                                                action="{{ route('kategori.destroy', $kategori->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-style-light"><i
                                                                        class="material-icons">delete</i>Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/highlight/styles/github-gist.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable1').DataTable();
        });
    </script>
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
@endpush
