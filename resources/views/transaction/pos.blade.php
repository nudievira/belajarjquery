@extends('template.home')
@section('content')
    @include('template.fungsi-php')

    <div class="container-xl">
        <div class="card ">
            <div class="card-header text-center">
                <h4 class="text-dark">Transaksi</h4>
            </div>
            <form action="#" id="form-customer">
                <div class="card-body row mt-n3">
                    <div class=" col-md-4 mr-2 ml-2 ">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label mb-n2">Customer</label>
                            </div>
                            <div class="col-md-9">
                                <select name="customer" id="customer" class="form-control form-control-sm select2"
                                    onchange="cariCutomer()">
                                    <option value="0">Umum</option>

                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Telp</label>
                            </div>
                            <div class="col-md-9">
                                <span id="telp">-</span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <label class="col-form-label  mb-n2">Alamat</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <span id="alamat">-</span>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <hr>

            <form action="#" id="form-inventory">
                <div class="d-flex flex-column justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-responsiv table-bordered nowrap" id="keranjang">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2"><a href="#" data-toggle="modal"
                                            data-target="#modalBarang">Tambah</a></th>
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
                            {{-- <tfoot>

                                <tr>
                                    <th class="text-end colspan">Total</th>
                                    <th class="ondesktop"></th>
                                    <th class="text-end" id="totalbelanja"></th>
                                </tr>

                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </form>
            <hr>

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
                <ul class="list-group">
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
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script>
        var i = 1;
        $(document).on('click', '.btnBarangSelected', function() {
            const id = $(this).data('id')
            const kode = $(this).data('kode')
            const nama = $(this).data('nama')
            const harga = $(this).data('harga')
            const jumlah = null;
            const total = 0;
            var html = `
                <tr data-id="${i}" id="row_${i}">
                    <td class="">
                        <a class="edit" id="editBtn_${i}" href="javascript:void(0)" data-edit="${i}">edit</a>
                        <a class="delete" id="deletebtn_${i}" href="javascript:void(0)" data-delete="${i}">hapus</a>
                    </td>
                    <td class="phoneview">${i}</td>
                    <td class="phoneview">
                    <p>${kode}</p>
                        <input name="id_b[]" class="form-control form-control-sm" type="hidden" id="inv${i}" value="${id}">
                        <input name="kode[]" class="form-control form-control-sm" type="hidden" id="inv${i}" value="${kode}">
                    </td>
                    <td>
                        <p>${nama}</p>
                        <input name="nama[]" class="form-control form-control-sm" type="hidden" id="nama${i}" value="${nama}" }}>
                    </td>
                    <td>
                        <div class="input-group input-group-sm mb-3">
                            <input name="jumlah[]" class="form-control form-control-sm money" type="number" id="jumlah_${i}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary okBtn" data-id="${i}" data-harga="${harga}" type="button" id="ok_${i}">OK</button>
                        </div>
                        </div>
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
                        <p class="totalText${i}"></p>
                        <input name="total[]" class="form-control form-control-sm money total_${i}" type="hidden" id="total${i}" value="${total}">
                    </td>
                   
                </tr>
                `;
            $('#modalBarang').modal('hide');
            $('#body-keranjang').append(html);
            i++;
        });
        // var i = 1;
        // var totalbelanja = 0;
        // $('#addBtn').on('click', function(e) {
        //     e.preventDefault();
        //     var id = $('#b_id').val(id)
        //     console.log(id);
        //     var kode = $('#b_kode').val(kode)
        //     var nama = $('#b_nama').val(nama)
        //     var harga = $('#b_harga').val(harga)
        //     var jumlah = $('#jumlah').val();
        //     var total = jumlah * harga;
        //     totalbelanja += total;

        // })
        $(document).on('click', '.okBtn', function(e) {
            var id = $(this).data('id');
            var harga = $(this).data('harga');
            var jumlah = $('#jumlah_' + id).val();
            var total = parseInt(jumlah) * parseInt(harga);

            console.log(total);
            $('#total' + id).val(total)
            $('.totalText' + id).html(total)

        });


        $(document).on('click', '.delete', function(e) {
            var id = $(this).data('delete');
            $('#row_' + id + '').remove();
            var totals = $(this).data('total');

            // var totals = 10000;
            totalbelanja -= totals;
            $('#totalbelanja').text(angkaBiasa(totalbelanja));
            $('.totalbayar').text(formatRupiah(totalbelanja));
            $('.totalkeranjang').text(formatRupiah(totalbelanja))
        });

        $(document).on('keyup', '#cash', function() {

            var cash = $('#cash').val();
            var kembalian;
            cash -= totalbelanja
            console.log(cash);
            $('.kembali').text(formatRupiah(cash));
        })




        $('#proccess').on('click', function(e) {
            e.preventDefault();
            var dataString = $("#form-customer, #form-inventory, #form-payment ").serialize();
            // console.log(dataString);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                // url: "{{ url('pos') }}",
                data: dataString,
                success: function(data) {
                    console.log(data);
                    // if (data.error) {
                    //     toastr.error(data.error);
                    // } else {
                    //     window.location.href = data.route
                    // }
                },
                error: function(err) {
                    toastr(data.error);
                }
            });
        });
    </script>
@endpush
