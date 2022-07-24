<?php

namespace App\Http\Controllers;

use App\Exports\ZakatExport;
use Carbon\Carbon;
use App\Models\Zakat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zakat = Zakat::orderBy('id', 'DESC')->get();
        return view('zakat.index', compact(['zakat']));
    }

    public function excel()
    {
        return Excel::download(new ZakatExport, 'zakat.xlsx');
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
    public function edit(Zakat $zakat)
    {
        return view('zakat.edit', compact(['zakat']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zakat $zakat)
    {
        $data = $request->all();
        $data['tanggal_transaksi'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_transaksi)->format('Y-m-d');
        $zakat->update($data);
        return redirect()->route('zakat.index')->with('alert', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zakat $zakat)
    {
        $zakat->delete();
        return redirect()->route('zakat.index')->with('alert', 'Data berhasil dihapus');
    }
}
