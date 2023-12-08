<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuans = Pengajuan::join('users', 'pengajuans.petani_id', '=', 'users.id')
            ->where('pengajuans.status', '0')
            ->select('pengajuans.*', 'users.username') // Change 'nama' with the actual column name in the users table that stores the name
            ->get();
        // dd($pengajuans);
        return view('komunitas.pengajuan', compact('pengajuans'), [
            'title' => 'Data Pengajuan'
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

    public function accept($id)
    {
        // Lakukan aksi menerima pengajuan berdasarkan $id
        // Misalnya, set status pengajuan menjadi diterima
        Pengajuan::where('id', $id)->update(['status' => '1']);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diterima');
    }

    public function reject($id)
    {
        Pengajuan::where('id', $id)->update(['status' => '2']);
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditolak');
    }
}
