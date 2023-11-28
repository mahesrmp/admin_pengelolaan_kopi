<?php

namespace App\Http\API;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    public function tambahData(Request $request)
    {
        $request->validate([
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'foto_selfie' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_pengalaman' => 'required|string',
            'foto_sertifikat' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $fotoKtpPath = $request->file('foto_ktp')->storeAs('public/pengajuan', 'foto_ktp_' . time() . '.' . $request->file('foto_ktp')->extension());
        // $fotoSelfiePath = $request->file('foto_selfie')->storeAs('public/pengajuan', 'foto_selfie_' . time() . '.' . $request->file('foto_selfie')->extension());
        // $fotoSertifikatPath = $request->file('foto_sertifikat')->storeAs('public/pengajuan', 'foto_sertifikat_' . time() . '.' . $request->file('foto_sertifikat')->extension());

        $fotoKtpPath = $request->file('foto_ktp')->store('pengajuanimage', 'public');
        $fotoSelfiePath = $request->file('foto_selfie')->store('pengajuanimage', 'public');
        $fotoSertifikatPath = $request->file('foto_sertifikat')->store('pengajuanimage', 'public');

        $pengajuan = Pengajuan::create([
            'foto_ktp' => $fotoKtpPath,
            'foto_selfie' => $fotoSelfiePath,
            'deskripsi_pengalaman' => $request->deskripsi_pengalaman,
            'foto_sertifikat' => $fotoSertifikatPath,
        ]);

        return response()->json(['message' => 'Data berhasil diajukan'], 200);
    }
}
