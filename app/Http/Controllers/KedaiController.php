<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kedai;
use Illuminate\Http\Request;

class KedaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kedais = Kedai::all();
        return view('kedai.kedai', compact('kedais'), [
            'title' => 'Kedai'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model'     => new Kedai(),
            'title'     => 'Form Tambah Informasi Kedai Kopi',
        ];

        return view('kedai.kedai_form', $data);
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
                'nama_kedai' => 'required',
                'alamat' => 'required',
                'deskripsi' => 'required',
                'jam_buka' => 'required',
                'jam_tutup' => 'required',
                'hari_buka' => 'required',
                'hari_tutup' => 'required',
                'no_telp' => 'required',
                'credit_gambar' => 'required',
                'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

            ]);

            $data = [
                'nama_kedai' => $request->nama_kedai,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'jam_buka' => $request->jam_buka,
                'jam_tutup' => $request->jam_tutup,
                'hari_buka' => $request->hari_buka,
                'hari_tutup' => $request->hari_tutup,
                'no_telp' => $request->no_telp,
                'credit_gambar' => $request->credit_gambar,
            ];

            if ($request->filled('hari_buka_lainnya')) {
                $data['hari_buka_lainnya'] = $request->hari_buka_lainnya;
            }

            if ($request->filled('hari_tutup_lainnya')) {
                $data['hari_tutup_lainnya'] = $request->hari_tutup_lainnya;
            }

            if ($request->filled('jam_buka_lainnya')) {
                $data['jam_buka_lainnya'] = $request->jam_buka_lainnya;
            }

            if ($request->filled('jam_tutup_lainnya')) {
                $data['jam_tutup_lainnya'] = $request->jam_tutup_lainnya;
            }

            $kedai = Kedai::create($data);

            if ($kedai) {
                foreach ($request->file('gambar') as $gambar) {
                    $gambarPath = $gambar->store('kedaiimage', 'public');

                    $kedai->images()->create([
                        'gambar' => $gambarPath,
                    ]);
                }

                return redirect()->route('kedai.index')->with('success', 'Informasi Kedai Kopi berhasil ditambahkan');
            } else {
                $errorMessage = $kedai->status() . ': ' . $kedai->body();
                throw new Exception('Failed to add product. ' . $errorMessage);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kedai  $kedai
     * @return \Illuminate\Http\Response
     */
    public function show(Kedai $kedai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kedai  $kedai
     * @return \Illuminate\Http\Response
     */
    public function edit(Kedai $kedai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kedai  $kedai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kedai $kedai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kedai  $kedai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kedai $kedai)
    {
        //
    }
}
