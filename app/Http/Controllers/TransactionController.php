<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['barang'] = Barang::all();
        $data['customer'] = Customer::all();
        $data['trx_id'] = 'TRX'.time();
        return view('transaction.pos',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validasi = Validator::make($request->all(),[
            'trx_id' => 'required',
            'customer'=>'required',
            'tanggal'=>'required',
            'dison'=>'required',
            'ongkir'=>'required'
        ]);
        if($validasi->fails()){
            return response()->json(['status'=>401,'msg'=>$validasi->errors()]);
        }
        $kode = $request->trx_id;
        $customer = $request->customer;
        $tanggal = $request->tanggal;
        $diskon = $request->dison;
        $ongkir = $request->ongkir;
        $barang = $request->barang_id;
        $jumlah = $request->jumlah;
        $totalProd = $request->total;
        $total  = $request->total_trx;
        $bayar  = $request->total_bayar;
        $hargab = $request->harga;
        DB::beginTransaction();
        try {
            $sales = Sales::create([
                'kode'=>$kode,
                'tgl'=>$tanggal,
                'cust_id'=>$customer,
                'subtotal'=>$total,
                'diskon'=>$diskon,
                'ongkir'=>$ongkir,
                'total_bayar'=>$bayar
            ]);
            foreach ($barang as $key => $value) {
                $barangID = $barang[$key];
                $jumlahB = $jumlah[$key];
                $harga_bandrol = $hargab[$key];
                $totalBarang = $totalProd[$key]; 
         
                SalesDetail::create([
                    'sales_id'  => $sales->id,
                    'barang_id' => $barangID,
                    'harga_bandrol' => $harga_bandrol,
                    'qty'=>$jumlahB,
                    'diskon_pct'    =>0,
                    'diskon_nilai'  =>0,
                    'harga_diskon'  =>0,
                    'total' => $totalBarang
                ]);
            }
            
            DB::commit();
            return response()->json(['status'=>200,'msg'=>'Transaksi Created']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status'=>500,'msg'=>'Transaksi Failed '.$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
