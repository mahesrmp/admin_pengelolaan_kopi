<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_petanis = Pengajuan::join('users', 'pengajuans.petani_id', '=', 'users.id')
            ->where('pengajuans.status', '1')
            ->select('pengajuans.*', 'users.username') // Change 'nama' with the actual column name in the users table that stores the name
            ->get();
        // dd($pengajuans);
        return view('komunitas.komunitas', compact('data_petanis'), [
            'title' => 'Data Petani'
        ]);
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
     * @param  \App\Models\Komunitas  $komunitas
     * @return \Illuminate\Http\Response
     */
    public function show(Komunitas $komunitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komunitas  $komunitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Komunitas $komunitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komunitas  $komunitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komunitas $komunitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komunitas  $komunitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komunitas $komunitas)
    {
        //
    }
}
