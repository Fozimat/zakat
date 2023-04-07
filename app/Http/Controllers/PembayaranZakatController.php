<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Zakat;
use App\Models\Muzakki;
use App\Exports\ZakatExport;
use App\Models\JumlahJiwa;
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
        $zakat = Zakat::with(['muzakki', 'amil'])->orderBy('id', 'DESC')->get();
        return view('zakat.index', compact(['zakat']));
    }

    public function invoice(Zakat $zakat)
    {
        $pdf = PDF::loadview('zakat.invoice', compact(['zakat']))->setPaper('A4', 'landscape');
        return $pdf->stream();
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
        $muzakki = Muzakki::orderBy('id', 'DESC')->get();
        return view('zakat.create', compact(['generate_no_transaksi', 'muzakki']));
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
        $data['tahun'] = Carbon::createFromFormat('m/d/Y', $request->tanggal_transaksi)->format('Y');
        // dd($data['tahun']);
        Zakat::create($data);
        $zakat = Zakat::latest('id')->first();
        $array = [];
        $jumlah_jiwa = $request->anggota_keluarga;
        if ($jumlah_jiwa > 1) {
            foreach ($jumlah_jiwa as $nama) {
                array_push($array, [
                    'zakat_id' => $zakat->id,
                    'nama' => $nama
                ]);
            }
            JumlahJiwa::insert($array);
        }
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
        $muzakki = Muzakki::orderBy('id', 'DESC')->get();
        return view('zakat.edit', compact(['zakat', 'muzakki']));
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
        JumlahJiwa::where('zakat_id', $zakat->id)->delete();
        $array = [];
        $jumlah_jiwa = $request->anggota_keluarga;
        if ($jumlah_jiwa > 1) {
            foreach ($jumlah_jiwa as $nama) {
                array_push($array, [
                    'zakat_id' => $zakat->id,
                    'nama' => $nama
                ]);
            }
            JumlahJiwa::insert($array);
        }
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
        $zakat->anggota_keluarga()->delete();
        $zakat->delete();
        return redirect()->route('zakat.index')->with('alert', 'Data berhasil dihapus');
    }
}
