<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Penerima;
use Illuminate\Http\Request;

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
                'nama' => $request->nama[$i]
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
