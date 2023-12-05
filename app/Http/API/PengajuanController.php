<?php

namespace App\Http\API;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function tambahData(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'deskripsi_pengalaman' => 'required|string',
                'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_selfie' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_sertifikat' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'petani_id' => 'required',
            ]);

            // Proses penyimpanan gambar jika ada
            $fotoKtpPath = $request->file('foto_ktp') ? $request->file('foto_ktp')->store('pengajuanimage', 'public') : null;
            $fotoSelfiePath = $request->file('foto_selfie') ? $request->file('foto_selfie')->store('pengajuanimage', 'public') : null;
            $fotoSertifikatPath = $request->file('foto_sertifikat') ? $request->file('foto_sertifikat')->store('pengajuanimage', 'public') : null;

            // Simpan data ke database
            $pengajuan = Pengajuan::create([
                'foto_ktp' => $fotoKtpPath,
                'foto_selfie' => $fotoSelfiePath,
                'deskripsi_pengalaman' => $request->deskripsi_pengalaman,
                'foto_sertifikat' => $fotoSertifikatPath,
                'petani_id' => $request->petani_id,
            ]);

            if ($pengajuan) {
                // Data added successfully
                return response()->json(['message' => 'Data berhasil diajukan', 'status' => 'success'], 200);
            } else {
                // Failed to add data
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
}
