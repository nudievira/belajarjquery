<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Barang';
        $data['table'] = Barang::all();
        return view('master.barang',$data);
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
        $valid = $request->validate([
            'kode'=>'required',
            'nama'=>'required',
            'harga'=>'required',
        ]);
        try {
            Barang::create($request->all());
            return redirect()->back()->with('success','Barang Created');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success','Error Created ',$th->getMessage());
            //throw $th;
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
        $cekBarang = Barang::find($id);
        if($cekBarang){
            $cekBarang->update($request->all());
            return redirect()->back()->with('success','Barang Updated');
        }else{
            return redirect()->back()->with('error','Barang Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Barang::find($id);
        if($cek){
            $cek->delete();
            return redirect()->back()->with('success','Barang Deleted');
        }else{
            return redirect()->back()->with('error','Barang Not Found');
        }
    }
}
