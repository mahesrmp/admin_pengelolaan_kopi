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
            // $fotoKtpPath = $request->file('foto_ktp') ? $request->file('foto_ktp')->store('pengajuanimage', 'public') : null;
            // $fotoSelfiePath = $request->file('foto_selfie') ? $request->file('foto_selfie')->store('pengajuanimage', 'public') : null;
            // $fotoSertifikatPath = $request->file('foto_sertifikat') ? $request->file('foto_sertifikat')->store('pengajuanimage', 'public') : null;
            $fotoKtpPath = null;
            if ($request->hasFile('foto_ktp')) {
                $uploadedFile = $request->file('foto_ktp');
                if ($uploadedFile->isValid()) {
                    $fotoKtpPath = $uploadedFile->store('pengajuanimage', 'public');
                } else {
                    return response()->json(['message' => 'Gagal mengunggah foto KTP', 'status' => 'error', 'error' => 'Invalid file'], 400);
                }
            }

            $fotoSelfiePath = null;
            if ($request->hasFile('foto_selfie')) {
                $uploadedFile = $request->file('foto_selfie');
                if ($uploadedFile->isValid()) {
                    $fotoSelfiePath = $uploadedFile->store('pengajuanimage', 'public');
                } else {
                    return response()->json(['message' => 'Gagal mengunggah foto selfie', 'status' => 'error', 'error' => 'Invalid file'], 400);
                }
            }

            $fotoSertifikatPath = null;
            if ($request->hasFile('foto_sertifikat')) {
                $uploadedFile = $request->file('foto_sertifikat');
                if ($uploadedFile->isValid()) {
                    $fotoSertifikatPath = $uploadedFile->store('pengajuanimage', 'public');
                } else {
                    return response()->json(['message' => 'Gagal mengunggah foto sertifikat', 'status' => 'error', 'error' => 'Invalid file'], 400);
                }
            }


            // Simpan data ke database
            $pengajuan = Pengajuan::create([
                'foto_ktp' => $fotoKtpPath,
                'foto_selfie' => $fotoSelfiePath,
                'deskripsi_pengalaman' => $request->deskripsi_pengalaman,
                'foto_sertifikat' => $fotoSertifikatPath,
                'petani_id' => $request->petani_id,
            ]);

            if ($pengajuan) {
                // Generate URLs for the images
                $fotoKtpUrl = $fotoKtpPath ? asset('storage/' . $fotoKtpPath) : null;
                $fotoSelfieUrl = $fotoSelfiePath ? asset('storage/' . $fotoSelfiePath) : null;
                $fotoSertifikatUrl = $fotoSertifikatPath ? asset('storage/' . $fotoSertifikatPath) : null;

                // Data added successfully, include image URLs in the response
                return response()->json([
                    'message' => 'Data berhasil diajukan',
                    'status' => 'success',
                    'foto_ktp_url' => $fotoKtpUrl,
                    'foto_selfie_url' => $fotoSelfieUrl,
                    'foto_sertifikat_url' => $fotoSertifikatUrl,
                ], 200);
            } else {
                // Failed to add data
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function getPengajuanData()
    {
        $pengajuanData = Pengajuan::get();

        // Transform data to include image URLs
        $transformedData = $pengajuanData->map(function ($item) {
            return [
                'id' => $item->id,
                'foto_ktp_url' => $item->foto_ktp ? asset('storage/' . $item->foto_ktp) : null,
                'foto_selfie_url' => $item->foto_selfie ? asset('storage/' . $item->foto_selfie) : null,
                'foto_sertifikat_url' => $item->foto_sertifikat ? asset('storage/' . $item->foto_sertifikat) : null,
                'deskripsi_pengalaman' => $item->deskripsi_pengalaman,
                'status' => $item->status,
                'petani_id' => $item->petani_id,
            ];
        });

        return response()->json($transformedData);
    }

    public function getPengajuanStatusData($id){
        $pengajuanStatusData = Pengajuan::select('status', 'id', 'petani_id')->where('petani_id', $id)->get();
        return response()->json($pengajuanStatusData);
    }
}
