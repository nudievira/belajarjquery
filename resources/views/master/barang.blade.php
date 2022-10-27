@extends('template.home')

@section('content')
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                Tambah
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($table as $i)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $i->kode }}</td>
                            <td>{{ $i->nama }}</td>
                            <td>{{ $i->harga }}</td>
                            <td>
                                <form action="{{ url('barang') . '/' . $i->id }}" method="POST">
                                    <button type="button" class="btn btn-warning btn-sm editBtn" data-toggle="modal"
                                        data-target="#edtModal" data-id="{{ $i->id }}"
                                        data-kode="{{ $i->kode }}" data-nama="{{ $i->nama }}"
                                        data-harga="{{ $i->harga }}">
                                        edit
                                    </button>
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('modal-add')
    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('barang') }}" method="POST">
                        @csrf
                        <span>Kode</span>
                        <input type="text" name="kode"
                            class="form-control @error('kode')
                            is-invalid
                        @enderror"
                            value="{{ old('kode') }}">
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <span>Nama</span>
                        <input type="text" name="nama"
                            class="form-control @error('nama')
                            is-invalid
                        @enderror"
                            value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <span>Harga</span>
                        <input type="number" name="harga"
                            class="form-control @error('harga')
                            is-invalid
                        @enderror"
                            value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="edtModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        <span>Kode</span>
                        <input type="text" name="kode"
                            class="form-control @error('kode')
                            is-invalid
                        @enderror"
                            value="{{ old('kode') }}" id="kode">
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <span>Nama</span>
                        <input type="text" name="nama"
                            class="form-control @error('nama')
                            is-invalid
                        @enderror"
                            value="{{ old('nama') }}" id="nama">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <span>Harga</span>
                        <input type="number" name="harga"
                            class="form-control @error('harga')
                            is-invalid
                        @enderror"
                            value="{{ old('harga') }}" id="harga">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script>
        $(document).ready(function() {
            $('.editBtn').on('click', function(e) {
                const id = $(this).data('id');
                const kode = $(this).data('kode');
                const nama = $(this).data('nama');
                const harga = $(this).data('harga');
                const url = "{{ url('barang') }}/" + id;
                // method = PUT, url http://test.com/barang/1
                $('#kode').val(kode)
                $('#nama').val(nama)
                $('#harga').val(harga)
                $('#formEdit').attr('action', url);
            })
        })
    </script>
@endpush
