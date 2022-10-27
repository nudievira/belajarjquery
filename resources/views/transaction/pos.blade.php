@extends('template.home')
@section('content')
    @include('template.fungsi-php')

    <div class="container-xl">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="text-dark">Transaksi</h4>
            </div>
            <form action="#" id="formTrx">
                <div class="card-body row mt-n3">
                    <div class=" col-md-4 mr-2 ml-2 ">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label mb-n2">Transaksi No</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="trx_id" id="trx_id" class="form-control"
                                    value="{{ $trx_id }}">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Tanggal</label>
                            </div>
                            <div class="col-md-9">
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                        </div>

                    </div>

                </div>
            </form>
            <hr>
            <form action="#" id="form-customer">
                <div class="card-body row mt-n3">
                    <div class=" col-md-4 mr-2 ml-2 ">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label mb-n2">Customer</label>
                            </div>
                            <div class="col-md-9">
                                <select name="customer" id="customerSelct" class="form-control form-control-sm select2">
                                    <option>--pilih</option>
                                    @foreach ($customer as $item)
                                        <option value="{{ $item->id }}" data-kode="{{ $item->kode }}"
                                            data-nama="{{ $item->name }}" data-telp="{{ $item->telp }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Kode</label>
                            </div>
                            <div class="col-md-9">
                                <span id="kode">-</span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Nama</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <span id="nama">-</span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Telp</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <span id="telp">-</span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="card-body">
                <form action="#" id="form-detailTrx">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="table-responsive">
                            <table class="table table-responsiv table-bordered nowrap" id="keranjang">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2"><a href="#" data-toggle="modal" data-target="#modalBarang"
                                                id="modalBtn">Tambah</a></th>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Kode</th>
                                        <th rowspan="2">Nama barang</th>
                                        <th rowspan="2">Qty</th>
                                        <th rowspan="2">Harga Bandrol</th>
                                        <th colspan="2">Diskon</th>
                                        <th rowspan="2">Harga Disokn</th>
                                        <th rowspan="2">Total</th>
                                    </tr>
                                    <tr>

                                        <th>%</th>
                                        <th>(Rp)</th>

                                    </tr>
                                </thead>
                                <tbody id="body-keranjang">
                                </tbody>
                                <tfoot id="footer" class="d-none">
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="txtTotal">Total</th>
                                        <th class="text-end" id="totalbelanja">
                                        </th>
                                        <input type="text" name="total_trx" hidden id="totalInp" value="0">
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="txtTotal">Diskon</th>
                                        <th><input type="number" name="dison" id="diskon"
                                                class="form-control form-control-sm"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="txtTotal">Ongkir</th>
                                        <th><input type="number" name="ongkir" id="ongkir"
                                                class="form-control form-control-sm"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="8"></th>
                                        <th class="txtTotal">
                                            Total
                                        </th>
                                        <th class="text-end" id="totalbayar">
                                        </th>
                                        <input type="text" name="total_bayar" hidden id="totalBayarInP"
                                            value="0">
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">

                <button class="btn btn-primary float-right" id="process">Simpan</button>
            </div>
        </div>
    </div>
@endsection
@push('modal-add')
    <div class="modal fade" id="modalBarang" tabindex="-1" aria-labelledby="modalBarangLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="modalBarangLabel">Select Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <ul class="list-group" id="inpBarang">
                    @foreach ($barang as $item)
                        <li class="list-group-item">
                            <button class="btn btn-sm btn-sm mr-4 btn-success btnBarangSelected"
                                data-id="{{ $item->id }}" data-harga="{{ $item->harga }}"
                                data-nama="{{ $item->nama }}" data-kode="{{ $item->kode }}">
                                <i class="fas fa-plus"></i></button>
                            <span class="text-bold">{{ $item->nama }}</span>
                            <span class="text-right float-right"> {{ formatRupiah($item->harga) }}</span>
                        </li>
                    @endforeach
                </ul>
                <ul class="list-group d-none" id="inpJumlah">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">
                                Jumlah Belanja
                            </div>
                            <div class="col-md-8">
                                <input type="text" id="brng_jumlah" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 d-none">
                                <input type="text" id="brng_id">
                                <input type="text" id="brng_kode">
                                <input type="text" id="brng_nama">
                                <input type="text" id="brng_harga">
                            </div>
                            <div class="col-md-8 mt-2">
                                <button class="btn btn-primary btn-sm " id="btnOK">OK</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script>
        $('#customerSelct').on('change', function(e) {
            const id = $(this).val();
            const kode = $(this).find(':selected').data('kode')
            const nama = $(this).find(':selected').data('nama')
            const telp = $(this).find(':selected').data('telp')
            $('#kode').html(kode);
            $('#nama').html(nama);
            $('#telp').html(telp);
        })
        $('#modalBtn').on('click', function() {
            $('#inpBarang').removeClass('d-none');
            $('#inpJumlah').addClass('d-none');
            $('#brng_id').val('')
            $('#brng_kode').val('')
            $('#brng_nama').val('')
            $('#brng_harga').val('')
            $('#brng_jumlah').val('')
        })
        $(document).on('click', '.btnBarangSelected', function() {
            const id = $(this).data('id')
            const kode = $(this).data('kode')
            const nama = $(this).data('nama')
            const harga = $(this).data('harga')
            $('#brng_id').val(id)
            $('#brng_kode').val(kode)
            $('#brng_nama').val(nama)
            $('#brng_harga').val(harga)
            $('#modalBarangLabel').html('Barang ' + nama + ' Selected')
            $('#inpBarang').addClass('d-none');
            $('#inpJumlah').removeClass('d-none');
        });
        var i = 1;
        var subTotal = 0;
        $(document).on('click', '#btnOK', function() {
            const id = $('#brng_id').val()
            const kode = $('#brng_kode').val()
            const nama = $('#brng_nama').val()
            const harga = $('#brng_harga').val()
            const jumlah = $('#brng_jumlah').val()
            const total = parseInt(jumlah) * parseInt(harga);
            subTotal += total;
            $('#totalbelanja').html(subTotal);
            $('#footer').removeClass('d-none');
            $('#totalInp').val(subTotal)
            // $('#totalbayar').html(subTotal)
            // $('#totalBayarInP').val(0);
            var html = `
                <tr data-id="${i}" id="row_${i}">
                    <td class="">
                        <a class="delete" id="deletebtn_${i}" href="javascript:void(0)" data-delete="${i}" data-total="${total}">hapus</a>
                    </td>
                    <td class="phoneview">${i}</td>
                    <td class="phoneview">
                    <p>${kode}</p>
                        <input name="barang_id[]" class="form-control form-control-sm" type="hidden" id="inv${i}" value="${id}">
                        <input name="kode[]" class="form-control form-control-sm" type="hidden" id="inv${i}" value="${kode}">
                    </td>
                    <td>
                        <p>${nama}</p>
                        <input name="nama[]" class="form-control form-control-sm" type="hidden" id="nama${i}" value="${nama}" }}>
                    </td>
                    <td>
                       <p>${jumlah}</p>
                        <input name="jumlah[]" class="form-control form-control-sm" type="hidden" id="nama${i}" value="${jumlah}" }}>

                    </td>
                    <td >
                       <p>${harga}</p>
                    </td> 
                    <td>
                        <p>0</p>
                        <input name="tot_diskon[]" class="form-control form-control-sm money" type="hidden" id="" value="">
                    </td>
                    </td> 
                    <td>
                          <p>-</p>
                        <input name="harga_diskon[]" class="form-control form-control-sm money" type="hidden" type="number" id="" value="${jumlah}">
                    </td>
                    <td>
                        <p>${harga}</p>
                        <input name="harga[]" class="form-control form-control-sm money" type="hidden" id="harga${i}" value="${harga}">
                    </td>
                    <td>
                        <p>${total}</p>
                        <input name="total[]" class="form-control form-control-sm money total_${i}" type="hidden" id="total${i}" value="${total}">
                    </td>
                   
                </tr>
                `;
            $('#modalBarang').modal('hide');
            $('#body-keranjang').append(html);
            i++;
        });
        $('#diskon').on('keyup', function() {
            const diskon = $(this).val();
            var totalBayar = $('#totalBayar').val();
            total = subTotal - parseInt(diskon);
            $('#totalbayar').html(total)
            $('#totalBayarInP').val(total);
        })
        $('#ongkir').on('keyup', function() {
            const ongkir = $(this).val();
            const diskon = $('#diskon').val();
            total = subTotal - parseInt(diskon) + parseInt(ongkir);
            $('#totalbayar').html(total);
            $('#totalBayarInP').val(total);
        })


        $(document).on('click', '.delete', function(e) {
            var id = $(this).data('delete');
            var totals = $(this).data('total');
            // $('#row_' + id + '').remove();

            // var totals = 10000;
            subTotal -= parseInt(totals);
            $('#totalbelanja').text(subTotal);
        });

        $(document).on('keyup', '#cash', function() {

            var cash = $('#cash').val();
            var kembalian;
            cash -= totalbelanja
            console.log(cash);
            $('.kembali').text(formatRupiah(cash));
        })




        $('#process').on('click', function(e) {
            e.preventDefault();
            var dataString = $("#formTrx, #form-customer, #form-detailTrx").serialize();
            console.log(dataString);
            $.ajax({
                type: 'POST',
                url: "{{ url('transaksi') }}",
                data: dataString,
                success: function(data) {
                    if (data.status == 200) {
                        alert(data.msg);
                        location.reload();
                    } else if (data.status == 500) {
                        alert(data.msg);
                        location.reload();
                    } else {
                        alert('validation error! please insert all input');
                    }
                }
            });
        });
    </script>
@endpush
