<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Panen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PanenController extends Controller
{
    public function index()
    {
        $panens = Panen::all();
        return view('panen.panen', compact('panens'), [
            'title' => 'Panen'
        ]);
    }

    public function create()
    {
        $data = [
            'model'     => new Panen(),
            'title'     => 'Form Tambah Informasi Panen',
        ];

        return view('panen.panen_form', $data);
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
                'tahapan' => 'required',
                'deskripsi' => 'required',
                'link' => 'required',
                'sumber_artikel' => 'required',
                'credit_gambar' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $gambar = $request->file('gambar');
            $gambarPath = $gambar->storeAs('panenimage', $gambar->getClientOriginalName(), 'public');

            if (empty($gambarPath)) {
                throw new Exception('Gagal mengunggah gambar ke penyimpanan.');
            }

            $panen = Panen::create([
                'tahapan' => $request->tahapan,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'sumber_artikel' => $request->sumber_artikel,
                'credit_gambar' => $request->credit_gambar,
                'gambar' => $gambarPath,
            ]);

            if ($panen) {
                return redirect()->route('panen.index')->with('success', 'Informasi Panen berhasil ditambahkan');
            } else {
                $errorMessage = $panen->status() . ': ' . $panen->body();
                throw new Exception('Failed to add product. ' . $errorMessage);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $panen = Panen::findOrFail($id);
        return view('panen.panen_edit', [
            'panen' => $panen,
            'title'     => 'Form Update data Informasi Panen',
        ]);
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
        $request->validate([
            'tahapan' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'sumber_artikel' => 'required',
            'credit_gambar' => 'required'
        ]);

        try {
            $panen = Panen::findOrFail($id);
            $panen->tahapan = $request->tahapan;
            $panen->deskripsi = $request->deskripsi;
            $panen->link = $request->link;
            $panen->sumber_artikel = $request->sumber_artikel;
            $panen->credit_gambar = $request->credit_gambar;

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $gambarPath = $gambar->storeAs('panenimage', $gambar->getClientOriginalName(), 'public');

                if (!empty($panen->gambar)) {
                    Storage::disk('public')->delete($panen->gambar);
                }

                $panen->gambar = $gambarPath;
            }

            $panen->save();

            if ($panen) {
                return redirect()->route('panen.index')->with('success', 'Data Informasi Panen Berhasil di Ubah');
            } else {
                throw new Exception('Gagal mengupdate data');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $panen = Panen::findOrFail($id);
            if (!empty($panen->gambar)) {
                Storage::disk('public')->delete($panen->gambar);
            }
            $panen->delete();
            if ($panen) {
                return redirect()->route('panen.index')->with('success', 'Data Informasi Panen Berhasil dihapus');
            } else {
                throw new Exception('Failed to delete.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
