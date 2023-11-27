<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pasca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PascaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pascas = Pasca::all();
        return view('pasca.pasca_panen', compact('pascas'), [
            'title' => 'Pasca'
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
            'model'     => new Pasca(),
            'title'     => 'Form Tambah Informasi Pasca pasca$pasca',
        ];

        return view('pasca.pasca_form', $data);
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
                'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $pasca = Pasca::create([
                'tahapan' => $request->tahapan,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'sumber_artikel' => $request->sumber_artikel,
                'credit_gambar' => $request->credit_gambar,
            ]);

            if ($pasca) {
                foreach ($request->file('gambar') as $gambar) {
                    $gambarPath = $gambar->store('pascaimage', 'public');

                    $pasca->images()->create([
                        'gambar' => $gambarPath,
                    ]);
                }

                return redirect()->route('pasca.index')->with('success', 'Informasi Pasca Panen berhasil ditambahkan');
            } else {
                $errorMessage = $pasca->status() . ': ' . $pasca->body();
                throw new Exception('Failed to add product. ' . $errorMessage);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasca  $pasca
     * @return \Illuminate\Http\Response
     */
    public function show(Pasca $pasca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasca  $pasca
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasca = Pasca::findOrFail($id);
        return view('pasca.pasca_edit', [
            'pasca' => $pasca,
            'title'     => 'Form Update data Informasi Pasca',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasca  $pasca
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
            $pasca = Pasca::findOrFail($id);
            $pasca->tahapan = $request->tahapan;
            $pasca->deskripsi = $request->deskripsi;
            $pasca->link = $request->link;
            $pasca->sumber_artikel = $request->sumber_artikel;
            $pasca->credit_gambar = $request->credit_gambar;

            if ($request->hasFile('gambar')) {
                $newImages = [];

                foreach ($request->file('gambar') as $newImage) {
                    $newImagePath = $newImage->store('pascaimage', 'public');
                    $newImages[] = ['gambar' => $newImagePath];
                }

                $this->deleteImages($pasca);

                $pasca->images()->delete();
                $pasca->images()->createMany($newImages);
            }

            $pasca->save();

            if ($pasca) {
                return redirect()->route('pasca.index')->with('success', 'Data Informasi Pasca Panen Berhasil di Ubah');
            } else {
                throw new Exception('Gagal mengupdate data');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasca  $pasca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pasca = Pasca::findOrFail($id);
            $this->deleteImages($pasca);
            $pasca->delete();
            if ($pasca) {
                return redirect()->route('pasca.index')->with('success', 'Data Informasi Pasca Panen Berhasil dihapus');
            } else {
                throw new Exception('Failed to delete.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    protected function deleteImages(pasca $pasca)
    {
        foreach ($pasca->images as $image) {
            Storage::disk('public')->delete($image->gambar);

            $image->delete();
        }
    }
}
