<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuans = Pengajuan::join('users', 'pengajuans.user_id', '=', 'users.id')
            ->where('pengajuans.status', '0')
            ->select('pengajuans.*', 'users.username') // Change 'nama' with the actual column name in the users table that stores the name
            ->get();
        // dd($pengajuans);
        return view('admin.komunitas.pengajuan', compact('pengajuans'), [
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
        try {
            $pengajuan = Pengajuan::find($id);
            if (!$pengajuan) {
                return redirect()->route('pengajuan.index')->with('error', 'Pengajuan tidak ditemukan');
            }

            $user = DB::table('users')->where('id', $pengajuan->user_id)->first();
            if ($user) {
                DB::table('users')
                    ->where('id', $pengajuan->user_id)
                    ->update(['role' => 'fasilitator']);

                $pengajuan->update(['status' => '1']);

                return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diterima dan role user diperbarui');
            } else {
                return redirect()->route('pengajuan.index')->with('error', 'User tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->route('pengajuan.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function reject($id)
    {
        Pengajuan::where('id', $id)->update(['status' => '2']);
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditolak');
    }

    public function get_data_user()
    {
        $getDataUser = User::all();
        // dd($getDataUser);
        return view('admin.users.index', compact('getDataUser'), [
            'title' => 'Informasi Data Users'
        ]);
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);

        $user->status = 1;
        $user->save();

        return redirect()->route('getDataUser')->with('success', 'Akun pengguna berhasil dinonaktifkan.');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->status = null;
        $user->save();

        return redirect()->route('getDataUser')->with('success', 'Akun pengguna berhasil diaktifkan kembali.');
    }
}
