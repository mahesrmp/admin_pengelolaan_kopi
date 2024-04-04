<?php

namespace App\Http\API;

use Illuminate\Http\Request;
use App\Models\PermintaanPembelian;
use App\Http\Controllers\Controller;

class PermintaanPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permintaanPembelianData = PermintaanPembelian::all();
        return response()->json($permintaanPembelianData);
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
        try {
            $request->validate([
                'nama_kopi' => 'required|string',
                'harga' => 'required|string',
                'stok' => 'required',
                'lokasi_pengiriman' => 'required|string',
                'deskripsi' => 'required',
                'pembeli' => 'required|string',
                'kualitas' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id' => 'required',
            ]);

            // Proses penyimpanan gambar jika ada
            // $fotoKtpPath = $request->file('foto_ktp') ? $request->file('foto_ktp')->store('pengajuanimage', 'public') : null;
            // $fotoSelfiePath = $request->file('foto_selfie') ? $request->file('foto_selfie')->store('pengajuanimage', 'public') : null;
            // $fotoSertifikatPath = $request->file('foto_sertifikat') ? $request->file('foto_sertifikat')->store('pengajuanimage', 'public') : null;
            $gambar = null;
            if ($request->hasFile('gambar')) {
                $uploadedFile = $request->file('gambar');
                if ($uploadedFile->isValid()) {
                    $gambar = $uploadedFile->store('permintaanpembelianimage', 'public');
                } else {
                    return response()->json(['message' => 'Gagal mengunggah Gambar Permintaan Pembelian', 'status' => 'error', 'error' => 'Invalid file'], 400);
                }
            }

            // $fotoSelfiePath = null;
            // if ($request->hasFile('foto_selfie')) {
            //     $uploadedFile = $request->file('foto_selfie');
            //     if ($uploadedFile->isValid()) {
            //         $fotoSelfiePath = $uploadedFile->store('pengajuanimage', 'public');
            //     } else {
            //         return response()->json(['message' => 'Gagal mengunggah foto selfie', 'status' => 'error', 'error' => 'Invalid file'], 400);
            //     }
            // }

            // $fotoSertifikatPath = null;
            // if ($request->hasFile('foto_sertifikat')) {
            //     $uploadedFile = $request->file('foto_sertifikat');
            //     if ($uploadedFile->isValid()) {
            //         $fotoSertifikatPath = $uploadedFile->store('pengajuanimage', 'public');
            //     } else {
            //         return response()->json(['message' => 'Gagal mengunggah foto sertifikat', 'status' => 'error', 'error' => 'Invalid file'], 400);
            //     }
            // }


            // Simpan data ke database
            $permintaanPembelian = PermintaanPembelian::create([
                'gambar' => $gambar,
                'nama_kopi' => $request->nama_kopi,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'lokasi_pengiriman' => $request->lokasi_pengiriman,
                'deskripsi' => $request->deskripsi,
                'pembeli' => $request->pembeli,
                'kualitas' => $request->kualitas,
                'user_id' => $request->user_id,
            ]);

            if ($permintaanPembelian) {
                // Generate URLs for the images
                $gambar = $gambar ? asset('storage/' . $gambar) : null;

                // Data added successfully, include image URLs in the response
                return response()->json([
                    'message' => 'Data berhasil diajukan',
                    'status' => 'success',
                    'foto_ktp_url' => $gambar,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageBudidaya  $imageBudidaya
     * @return \Illuminate\Http\Response
     */
    public function show(PermintaanPembelian $ermintaanPembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageBudidaya  $imageBudidaya
     * @return \Illuminate\Http\Response
     */
    public function edit(PermintaanPembelian $ermintaanPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageBudidaya  $imageBudidaya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermintaanPembelian $ermintaanPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageBudidaya  $imageBudidaya
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermintaanPembelian $permintaanPembelian)
    {
        //
    }
}
