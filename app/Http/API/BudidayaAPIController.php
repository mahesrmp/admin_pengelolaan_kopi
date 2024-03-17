<?php

namespace App\Http\API;

use App\Models\Kedai;
use App\Models\Panen;
use App\Models\Pasca;
use App\Models\Budidaya;
use App\Models\Komunitas;
use App\Models\Pengajuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BudidayaAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budidayas = DB::table('budidayas')
            ->join('image_budidayas', 'budidayas.id', '=', 'image_budidayas.budidaya_id')
            ->select('budidayas.*', 'image_budidayas.gambar')
            ->get();
        return response()->json($budidayas);
    }

    public function getSyaratTumbuhData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Syarat Tumbuh')->get();
        return response()->json($budidayaData);
    }

    public function getPolaTanamData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Pola Tanam')->get();
        return response()->json($budidayaData);
    }

    public function getPohonPelindungData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Pohon Pelindung')->get();
        return response()->json($budidayaData);
    }

    public function getPembibitanData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Pembibitan')->get();
        return response()->json($budidayaData);
    }

    public function getPemupukanData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Pemupukan')->get();
        return response()->json($budidayaData);
    }

    public function getPemangkasanData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Pemangkasan')->get();
        return response()->json($budidayaData);
    }

    public function getHamaPenyakitData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Hama dan Penyakit')->get();
        return response()->json($budidayaData);
    }

    public function getSanitasiKebunData()
    {
        $budidayaData = Budidaya::with('images')->where('kategori', 'Sanitasi Kebun')->get();
        return response()->json($budidayaData);
    }

    public function select_tahapan()
    {
        $tahapan = DB::table('budidayas')
            ->select('tahapan')
            ->get();
        return response()->json($tahapan);
    }

    public function panen()
    {
        $panens = DB::table('panens')
            ->join('image_panens', 'panens.id', '=', 'image_panens.panen_id')
            ->select('panens.*', 'image_panens.gambar')
            ->get();
        return response()->json($panens);
    }

    public function getCiriBuahKopiData()
    {
        $panenData = Panen::with('images')->where('kategori', 'Ciri Buah Kopi')->get();
        return response()->json($panenData);
    }

    public function getPemetikanData()
    {
        $panenData = Panen::with('images')->where('kategori', 'Pemetikan')->get();
        return response()->json($panenData);
    }

    public function getFermentasiKeringData()
    {
        $pascaData = Pasca::with('images')->where('kategori', 'Fermentasi Kering')->get();
        return response()->json($pascaData);
    }

    public function getFermentasiMekanisData()
    {
        $pascaData = Pasca::with('images')->where('kategori', 'Fermentasi Mekanis')->get();
        return response()->json($pascaData);
    }

    public function getKedaiData()
    {
        $kedaiData = Kedai::with('images')->get();
        return response()->json($kedaiData);
    }

    public function getKomunitasData()
    {
        $komunitas = Pengajuan::select('pengajuans.foto_selfie', 'pengajuans.deskripsi_pengalaman', 'pengajuans.no_telp', 'pengajuans.kabupaten', 'users.username')
        ->join('users', 'pengajuans.petani_id', '=', 'users.id')
        ->where('pengajuans.status', '1')
        ->get();
        // Transformasi URL foto_selfie
        $komunitas = $komunitas->map(function ($item) {
            $item['foto_selfie'] = url("storage/" . $item['foto_selfie']);
            return $item;
        });

        return response()->json($komunitas);
    }
}
