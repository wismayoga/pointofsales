{{-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
@extends('layouts/main')
@section('title', 'Produk')

@section('content')
    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambah">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="py-2 needs-validation" action="{{ route('produk.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Masukan nama..." id="nama"
                                aria-describedby="nama" name="nama" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <label for="kategori" class="form-label mt-3">Kategori</label>
                        <select class="form-select" aria-label="Default select example" id="kategori" name="kategori"
                            required>
                            <option selected value="{{ null }}">--Pilih Kategori--</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>

                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control" placeholder="Masukan merk..." id="merk"
                                aria-describedby="merk" name="merk" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" placeholder="Masukan harga beli..." id="harga_beli"
                                aria-describedby="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number" class="form-control" placeholder="Masukan diskon..." id="diskon"
                                aria-describedby="diskon" name="diskon" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" placeholder="Masukan harga jual..." id="harga_jual"
                                aria-describedby="harga_jual" name="harga_jual" required>
                        </div>
                        <div class="invalid-feedback">
                            Tidak boleh kosong
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" placeholder="Masukan stok..." id="stok"
                                aria-describedby="stok" name="stok" required>
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
                            <h1>Daftar Produk</h1>
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
                                    {{-- <form id="deleteForm" action="{{ route('produk.deleteSelected') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-style-light">
                                            <i class="material-icons">delete</i>Delete Selected
                                        </button>
                                    </form> --}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <table id="datatable1" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            {{-- <th width="5%">
                                                <input type="checkbox" name="selected_produks[]" class="select-checkbox">
                                            </th> --}}
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Merk</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Diskon</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produks as $key => $produk)
                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="modalEdit{{ $produk->id }}" tabindex="-1"
                                                aria-labelledby="modalEdit{{ $produk->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEdit{{ $produk->id }}">Edit
                                                                Produk</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form class="py-2 needs-validation"
                                                            action="{{ route('produk.update', $produk->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama
                                                                        Produk</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Masukan nama..."
                                                                        value="{{ $produk->nama_produk }}" id="nama"
                                                                        aria-describedby="nama" name="nama" required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>

                                                                <label for="kategori"
                                                                    class="form-label mt-3">Kategori</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="kategori"
                                                                    name="kategori" required>
                                                                    <option selected value="{{ $produk->id_kategori }}">
                                                                        {{ $produk->nama_kategori }}</option>
                                                                    @foreach ($kategoris as $kategori)
                                                                        @if ($kategori->id !== $produk->id_kategori)
                                                                            <option value="{{ $kategori->id }}">
                                                                                {{ $kategori->nama_kategori }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                                <div class="mb-3">
                                                                    <label for="merk" class="form-label">Merk</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Masukan merk..."
                                                                        value="{{ $produk->merk }}" id="merk"
                                                                        aria-describedby="merk" name="merk" required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="harga_beli" class="form-label">Harga
                                                                        Beli</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Masukan harga beli..."
                                                                        value="{{ $produk->harga_beli }}" id="harga_beli"
                                                                        aria-describedby="harga_beli" name="harga_beli"
                                                                        required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="diskon"
                                                                        class="form-label">Diskon</label>
                                                                    <input type="number" class="form-control"
                                                                        value="{{ $produk->diskon }}"
                                                                        placeholder="Masukan diskon..." id="diskon"
                                                                        aria-describedby="diskon" name="diskon" required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="harga_jual" class="form-label">Harga
                                                                        Jual</label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Masukan harga jual..."
                                                                        value="{{ $produk->harga_jual }}" id="harga_jual"
                                                                        aria-describedby="harga_jual" name="harga_jual"
                                                                        required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="stok" class="form-label">Stok</label>
                                                                    <input type="number" class="form-control"
                                                                        value="{{ $produk->stok }}"
                                                                        placeholder="Masukan stok..." id="stok"
                                                                        aria-describedby="stok" name="stok" required>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Tidak boleh kosong
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <tr>
                                                {{-- <td>
                                                    <input type="checkbox" name="selected_produks[]"
                                                        class="select-checkbox">
                                                </td> --}}
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <h5 class="mt-1"><span
                                                            class="badge badge-success badge-style-light">{{ $produk->kode_produk }}</span>
                                                    </h5 class="mt-1">
                                                </td>
                                                <td>{{ $produk->nama_produk }}</td>
                                                <td>{{ $produk->nama_kategori }}</td>
                                                <td>{{ $produk->merk }}</td>
                                                <td>{{ $produk->harga_beli }}</td>
                                                <td>{{ $produk->harga_jual }}</td>
                                                <td>{{ $produk->diskon }}</td>
                                                <td>{{ $produk->stok }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col text-end">
                                                            <button type="button" class="btn btn-warning btn-style-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEdit{{ $produk->id }}"><i
                                                                    class="material-icons">edit</i>Edit</button>
                                                        </div>
                                                        <div class="col">
                                                            <form onsubmit="return confirm('Yakin Menghapus Produk?');"
                                                                action="{{ route('produk.destroy', $produk->id) }}"
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
    {{-- <script>
        $(document).ready(function() {
            console.log("Document ready");

            $('#select_all').click(function() {
                console.log("Select all clicked");
                $('.select-checkbox').prop('checked', this.checked);
            });

            $('.select-checkbox').change(function() {
                console.log("Individual checkbox changed");
                // Your existing code here
            });
        });
    </script> --}}
@endpush
