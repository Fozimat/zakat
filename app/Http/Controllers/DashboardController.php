<?php

namespace App\Http\Controllers;

use App\Models\Zakat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_zakat_fitrah = Zakat::sum('total_zakat_fitrah_uang');
        $total_zakat_fitrah_beras = Zakat::sum('zakat_fitrah_beras');
        $total_zakat_mal = Zakat::sum('zakat_mal');
        $total_zakat_fidyah = Zakat::sum('zakat_fidyah');
        $total_infaq = Zakat::sum('infaq');
        return view('dashboard.index', compact(['total_zakat_fitrah_beras', 'total_zakat_fitrah', 'total_zakat_mal', 'total_zakat_fidyah', 'total_infaq']));
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
