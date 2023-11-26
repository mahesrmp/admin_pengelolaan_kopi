<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use App\Models\Budidaya;
use Illuminate\Http\Request;
use App\Models\ImageBudidaya;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BudidayaController extends Controller
{
    public function index()
    {
        $budidayas = Budidaya::all();
        return view('budidaya.budidaya', compact('budidayas'), [
            'title' => 'Budidaya'
        ]);
    }

    public function create()
    {
        $data = [
            'model'     => new Budidaya(),
            'title'     => 'Form Tambah Informasi Budidaya',
        ];

        return view('budidaya.budidaya_form', $data);
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
                'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            $budidaya = Budidaya::create([
                'tahapan' => $request->tahapan,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'sumber_artikel' => $request->sumber_artikel,
                'credit_gambar' => $request->credit_gambar,
            ]);

            if ($budidaya) {
                foreach ($request->file('gambar') as $gambar) {
                    $gambarPath = $gambar->storeAs('budidayaimage', $gambar->getClientOriginalName(), 'public');

                    // Simpan path gambar ke dalam tabel image_budidayas
                    $budidaya->images()->create([
                        'gambar' => $gambarPath,
                    ]);
                }

                return redirect()->route('budidaya.index')->with('success', 'Informasi Budidaya berhasil ditambahkan');
            } else {
                $errorMessage = $budidaya->status() . ': ' . $budidaya->body();
                throw new Exception('Failed to add product. ' . $errorMessage);
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $budidaya = Budidaya::findOrFail($id);
        return view('budidaya.budidaya_edit', [
            'budidaya' => $budidaya,
            'title'     => 'Form Update data Informasi Budidaya',
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
            $budidaya = Budidaya::findOrFail($id);
            $budidaya->tahapan = $request->tahapan;
            $budidaya->deskripsi = $request->deskripsi;
            $budidaya->link = $request->link;
            $budidaya->sumber_artikel = $request->sumber_artikel;
            $budidaya->credit_gambar = $request->credit_gambar;

            if ($request->hasFile('gambar')) {
                $newImages = [];

                foreach ($request->file('gambar') as $newImage) {
                    $newImagePath = $newImage->storeAs('budidayaimage', $newImage->getClientOriginalName(), 'public');
                    $newImages[] = ['gambar' => $newImagePath];
                }

                $this->deleteImages($budidaya);

                $budidaya->images()->delete();
                $budidaya->images()->createMany($newImages);
            }

            $budidaya->save();

            if ($budidaya) {
                return redirect()->route('budidaya.index')->with('success', 'Data Informasi Budidaya Berhasil di Ubah');
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
            $budidaya = Budidaya::findOrFail($id);
            $this->deleteImages($budidaya);
            $budidaya->delete();
            if ($budidaya) {
                return redirect()->route('budidaya.index')->with('success', 'Data Informasi Budidaya Berhasil dihapus');
            } else {
                throw new Exception('Failed to delete.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    protected function deleteImages(Budidaya $budidaya)
    {
        foreach ($budidaya->images as $image) {
            Storage::disk('public')->delete($image->gambar);

            $image->delete();
        }
    }

    public function removeImage(Request $request)
    {
        try {
            // Validasi request
            $request->validate([
                'id' => 'required|exists:image_budidayas,id',
            ]);

            // Ambil ID gambar dari request
            $imageId = $request->input('image_id');

            // Hapus gambar dari database
            $image = ImageBudidaya::find($imageId);
            if (!$image) {
                throw new \Exception('Gambar tidak ditemukan.');
            }

            // Hapus gambar dari penyimpanan (storage)
            Storage::disk('public')->delete($image->path);

            // Hapus record gambar dari database
            $image->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
