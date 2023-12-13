{{-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
@extends('layouts/main')
@section('title', 'Produk')
@section('content')
    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambah">Tambah Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="py-2 needs-validation" action="{{ route('member.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Member</label>
                            <input type="text" class="form-control kode" placeholder="Masukan kode..." id="kode"
                                aria-describedby="kode" name="kode" readonly value="">
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Member</label>
                            <input type="text" class="form-control" placeholder="Masukan nama..." id="nama"
                                aria-describedby="nama" name="nama" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" placeholder="Masukan alamat..." id="alamat"
                                aria-describedby="alamat" name="alamat" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="number" class="form-control" placeholder="Masukan telepon..." id="telepon"
                                aria-describedby="telepon" name="telepon" required>
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

    @foreach ($members as $key => $member)
        <!-- Modal Edit-->
        <div class="modal fade" id="modalEdit{{ $member->id }}" tabindex="-1"
            aria-labelledby="modalEdit{{ $member->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEdit{{ $member->id }}">
                            Edit
                            Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="py-2 needs-validation" action="{{ route('member.update', $member->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode
                                    Member</label>
                                <input type="text" class="form-control" placeholder="Masukan nama..."
                                    value="{{ $member->kode_member }}" id="kode" aria-describedby="kode" name="kode"
                                    readonly>
                            </div>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama
                                    Member</label>
                                <input type="text" class="form-control" placeholder="Masukan nama..."
                                    value="{{ $member->nama }}" id="nama" aria-describedby="nama" name="nama"
                                    required>
                            </div>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" placeholder="Masukan alamat..."
                                    value="{{ $member->alamat }}" id="merk" aria-describedby="alamat"
                                    name="alamat" required>
                            </div>
                            <div class="invalid-feedback">
                                Tidak boleh kosong
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" placeholder="Masukan telepon..."
                                    value="{{ $member->telepon }}" id="telepon" aria-describedby="telepon"
                                    name="telepon" required>
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
                            <h1>Daftar Member</h1>
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

                                    {{-- <button onclick="cetakBarcode('{{ route('produk.cetakBarcode') }}')"
                                        class="btn btn-light">
                                        <i class="material-icons">qr_code</i>Cetak Barcode
                                    </button> --}}

                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" class="form-produk" enctype="multipart/form-data">
                                    @csrf
                                    <table id="datatable1" class="display nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th width="5%">
                                                    <input type="checkbox" id="check_all">
                                                </th> --}}
                                                <th>No</th>
                                                <th>Kode Member</th>
                                                <th>Nama Member</th>
                                                <th>Alamat</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $key => $member)
                                                <tr id="tr_{{ $member->id }}">
                                                    {{-- <td>
                                                        <input type="checkbox" class="checkbox" name="id[]"
                                                            value="{{ $member->id }}" data-id="{{ $member->id }}">
                                                    </td> --}}
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <h5 class="mt-1"><span
                                                                class="badge badge-success badge-style-light">{{ $member->kode_member }}</span>
                                                        </h5 class="mt-1">
                                                    </td>
                                                    <td>{{ $member->nama }}</td>
                                                    <td>{{ $member->alamat }}</td>
                                                    <td>{{ $member->telepon }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col text-end">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-style-light"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalEdit{{ $member->id }}"><i
                                                                        class="material-icons">edit</i>Edit</button>
                                                            </div>
                                                            <div class="col">
                                                                <form onsubmit="return confirm('Yakin Menghapus Member?');"
                                                                    action="{{ route('member.destroy', $member->id) }}"
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
                                </form>
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
    <script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // Handle "Tambah" button click event
            $('#modalTambah').on('shown.bs.modal', function() {
                console.log('Modal shown!');
                // Generate Kode Member based on yyyymmddtime format
                var currentDate = new Date();
                var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
                var day = ('0' + currentDate.getDate()).slice(-2);
                var hours = ('0' + currentDate.getHours()).slice(-2);
                var minutes = ('0' + currentDate.getMinutes()).slice(-2);
                var seconds = ('0' + currentDate.getSeconds()).slice(-2);
                var kodeMemberValue = month + day + hours + minutes + seconds;

                // Set the generated value to the Kode Member input field
                $('#kode').val(kodeMemberValue);
            });
        });
    </script>
@endpush
