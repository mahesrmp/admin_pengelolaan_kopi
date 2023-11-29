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
            $request->validate([
                'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'foto_selfie' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'deskripsi_pengalaman' => 'required|string',
                'foto_sertifikat' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Get the ID of the logged-in user
            $petaniId = Auth::id();
    
            $fotoKtpPath = $request->file('foto_ktp')->store('pengajuanimage', 'public');
            $fotoSelfiePath = $request->file('foto_selfie')->store('pengajuanimage', 'public');
            $fotoSertifikatPath = $request->file('foto_sertifikat')->store('pengajuanimage', 'public');
    
            $pengajuan = Pengajuan::create([
                'foto_ktp' => $fotoKtpPath,
                'foto_selfie' => $fotoSelfiePath,
                'deskripsi_pengalaman' => $request->deskripsi_pengalaman,
                'foto_sertifikat' => $fotoSertifikatPath,
                'petani_id' => $petaniId, // Save the user ID in the petani_id column
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
