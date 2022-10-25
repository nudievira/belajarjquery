@extends('template.home')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0">Daftar Transaksi</h1>
          </div><!-- /.col -->
        
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Transaksi</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Customer</th>
                    <th>Jumlah Bareng</th>
                    <th>Sub Total</th>
                    <th>Diskon</th>
                    <th>Ongkir</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>183</td>
                    <td>183</td>
                    <td>183</td>
                    <td>183</td>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">Approved</span></td>
                    <td>Bacon </td>
                  </tr>
                  <tr style="font-weight: : bold">
                    <td colspan="8" class="text-center">Grand Total</td>
                    <td>2000</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection