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
                    <th scope="col">Nama Customer</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($customer as $row)                  
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $row->kode }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->telp }}</td>
                        <td>
                          <form action="{{ url('customer') . '/' . $row->id }}" method="POST">
                            <button type="button" class="btn btn-warning btn-sm editBtn" data-toggle="modal"
                            data-target="#edtModel" 
                            data-id="{{ $row->id }}"
                            data-kode="{{ $row->kode }}"
                            data-name="{{ $row->name }}"
                            data-telp="{{ $row->telp }}">
                            Edit</button>
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
<!-- Modal Tambah-->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('customer') }}" method="POST">
          @csrf
          <span>Kode</span>
          <input type="text" name="kode"class="form-control">
        <span>Nama Customer</span>
        <input type="text" name="name" class="form-control">
        <span>No Telepon</span>
        <input type="text" name="telp" class="form-control">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit-->
  <div class="modal fade" id="edtModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <input type="text" name="name"
              class="form-control @error('name')
              is-invalid
          @enderror"
              value="{{ old('nama') }}" id="name">
          @error('nama')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
          <span>No Telepon</span>
          <input type="number" name="telp"
              class="form-control @error('telp')
              is-invalid
          @enderror"
              value="{{ old('harga') }}" id="telp">
          @error('harga')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror

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
      $(document).ready(function(){
        $('.editBtn').on('click', function(e) {
          const id = $(this).data('id');
          const kode = $(this).data('kode');
          const name = $(this).data('name');
          const telp = $(this).data('telp');
          const url = "{{ url('customer') }}/" + id;
                // method = PUT, url http://test.com/customer/1
          $('#kode').val(kode)
          $('#name').val(name)
          $('#telp').val(telp)
          $('#formEdit').attr('action', url);
        })
      })
    </script>
@endpush