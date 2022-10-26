<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer['title'] = 'Customer';
        $customer['customer'] = Customer::all();
        return view('master.customer',$customer);
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
            'kode' => 'required',
            'name' => 'required',
            'telp' =>'required'
        ]);
        try {
            Customer::create($request->all());
            return redirect()->back()->with('success','Barang Created');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success','Error Created ',$th->getMessage());
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
        $cekCustomer = Customer::find($id);
        if ($cekCustomer) {
            $cekCustomer->update($request->all());
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
        $hapus = Customer::find($id);
        if ($hapus) {
            $hapus->delete();
            return redirect()->back()->with('success','Barang Updated');
        }else{
            return redirect()->back()->with('error','Barang Not Found');
        }
        
    }
}
