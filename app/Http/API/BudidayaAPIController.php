<?php

namespace App\Http\API;

use App\Models\Panen;
use App\Models\Budidaya;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

    public function panen()
    {
        $panens = Panen::all();
        return response()->json($panens);
    }
}
