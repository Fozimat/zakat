<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Zakat;
use Illuminate\Http\Request;

class PembayaranZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat = Zakat::all();
        return view('zakat.index', compact(['zakat']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::now()->isoFormat('DDMMYY');
        $number = Zakat::max('id') + 1;
        $generate = str_pad($number, 4, '0', STR_PAD_LEFT);
        $generate_no_transaksi = $today . $generate;
        return view('zakat.create', compact(['generate_no_transaksi']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['tanggal_transaksi'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_transaksi)->format('Y-m-d');
        Zakat::create($data);
        return redirect()->route('zakat.index')->with('alert', 'Data berhasil ditambahkan');
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
