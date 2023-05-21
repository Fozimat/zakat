<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Zakat;
use App\Models\Penerima;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.index');
    }

    public function cetakKeseluruhan(Request $request)
    {
        $dari_tanggal = Carbon::createFromFormat('m/d/Y', $request->dari_tanggal)->format('Y-m-d');;
        $sampai_tanggal = Carbon::createFromFormat('m/d/Y', $request->sampai_tanggal)->format('Y-m-d');;
        $zakat = Zakat::whereBetween('tanggal_transaksi', [$dari_tanggal, $sampai_tanggal])->orderBy('tanggal_transaksi', 'ASC')->get();
        $pdf = PDF::loadview('zakat.keseluruhan', compact(['zakat', 'dari_tanggal', 'sampai_tanggal']))->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function cetakDistribusi(Request $request)
    {
        $dari_tanggal = Carbon::createFromFormat('m/d/Y', $request->dari_tanggal)->format('Y-m-d');;
        $sampai_tanggal = Carbon::createFromFormat('m/d/Y', $request->sampai_tanggal)->format('Y-m-d');;
        $penerima = Penerima::with(['golongan'])->whereBetween('tanggal', [$dari_tanggal, $sampai_tanggal])->orderBy('golongan_id', 'ASC')->orderBy('id', 'ASC')->get();
        $pdf = PDF::loadview('zakat.distribusi', compact(['penerima', 'dari_tanggal', 'sampai_tanggal']))->setPaper('A4', 'landscape');
        return $pdf->stream();
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
        //
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
