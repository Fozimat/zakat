<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use App\Models\Golongan;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $golongan = Golongan::all();
        $penerima = Penerima::with(['golongan'])->orderBy('id', 'DESC')->get();
        return view('penerima.index', compact(['penerima', 'golongan']));
    }

    public function distribusi()
    {
        $total_zakat_fitrah = Zakat::whereYear('tanggal_transaksi', date('Y'))->sum('total_zakat_fitrah_uang');
        $total_beras = Zakat::whereYear('tanggal_transaksi', date('Y'))->sum('zakat_fitrah_beras');
        $total_zakat_mal = Zakat::whereYear('tanggal_transaksi', date('Y'))->sum('zakat_mal');
        $total_zakat_fidyah = Zakat::whereYear('tanggal_transaksi', date('Y'))->sum('zakat_fidyah');

        $semua_kategori = Penerima::whereYear('created_at', date('Y'))->get();
        $total_semua_kategori = $semua_kategori->count();

        $fakir_miskin = Penerima::whereIn('golongan_id', [1, 2])->whereYear('created_at', date('Y'))->get();
        $total_fakir_miskin = $fakir_miskin->count();

        $zakat_fitrah = $total_zakat_fitrah / $total_semua_kategori;
        $zakat_mal = $total_zakat_mal / $total_fakir_miskin;
        $zakat_fidyah = $total_zakat_fidyah / $total_fakir_miskin;
        $zakat_beras = $total_beras / $total_fakir_miskin;

        foreach ($semua_kategori as $semua) {
            DB::table('penerima')
                ->where('terima', 0)
                ->whereIn('golongan_id', [1, 2])
                ->update([
                    'zakat_mal' => $zakat_mal,
                    'zakat_fidyah' => $zakat_fidyah,
                    'zakat_beras' => $zakat_beras,
                ]);
        }

        foreach ($semua_kategori as $semua) {
            DB::table('penerima')
                ->where('terima', 0)
                ->update([
                    'zakat_fitrah' => $zakat_fitrah,
                    'terima' => 1,
                ]);
        }

        Zakat::where('distribusi', 0)->update(['distribusi' => 1]);
        return redirect()->route('penerima.index')->with('alert', 'Zakat berhasil didistribusikan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $golongan = Golongan::all();
        return view('penerima.create', compact(['golongan']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $golongan = $request->golongan_id;
        $i = 0;
        $data = [];

        foreach ($golongan as $gol) {
            array_push($data, [
                'golongan_id' => $gol,
                'nama' => $request->nama[$i],
                'terima' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $i++;
        }
        Penerima::insert($data);
        return redirect()->route('penerima.index')->with('alert', 'Data berhasil ditambahkan');
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
    public function edit(Penerima $penerima)
    {
        $golongan = Golongan::all();
        return view('penerima.edit', compact(['penerima', 'golongan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penerima $penerima)
    {
        $penerima->update($request->all());
        return redirect()->route('penerima.index')->with('alert', ' Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerima $penerima)
    {
        $penerima->delete();
        return redirect()->route('penerima.index')->with('alert', ' Data berhasil dihapus');
    }
}
