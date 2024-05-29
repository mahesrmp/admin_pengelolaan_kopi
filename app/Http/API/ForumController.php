<?php

namespace App\Http\API;

use App\Models\Forum;
use App\Models\LikeForum;
use Illuminate\Http\Request;
use App\Models\KomentarForum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('images')->get();
        return response()->json($forums);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id' => 'required',
            ]);

            $forum = Forum::create([
                'title' => $request->title,
                'deskripsi' => $request->deskripsi,
                'user_id' => $request->user_id,
            ]);

            if ($forum) {
                $gambarPath = null;
                if ($request->hasFile('gambar')) {
                    $uploadedFile = $request->file('gambar');
                    if ($uploadedFile->isValid()) {
                        $gambarPath = $uploadedFile->store('forumimage', 'public');
                        $forum->images()->create(['gambar' => $gambarPath]);
                    } else {
                        return response()->json(['message' => 'Gagal mengunggah Gambar', 'status' => 'error', 'error' => 'Invalid file'], 400);
                    }
                }

                // Generate URL for the image
                $gambarUrl = $gambarPath ? asset('storage/' . $gambarPath) : null;

                // Data added successfully, include image URL in the response
                return response()->json([
                    'message' => 'Forum berhasil ditambahkan',
                    'status' => 'success',
                    'gambar' => $gambarUrl,
                ], 200);
            } else {
                // Failed to add data
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $forum = Forum::with('images')->find($id);

            if (!$forum) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            return response()->json(['data' => $forum, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $forum = Forum::find($id);

            if (!$forum) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            // Cek apakah ada file gambar yang diunggah
            if ($request->hasFile('gambar')) {
                $uploadedFile = $request->file('gambar');
                if ($uploadedFile->isValid()) {
                    $gambarPath = $uploadedFile->store('forumimage', 'public');

                    if ($forum->images()->exists()) {
                        $forum->images()->first()->delete();
                    }
                    $forum->images()->create(['gambar' => $gambarPath]);
                } else {
                    return response()->json(['message' => 'Gagal mengunggah Gambar', 'status' => 'error', 'error' => 'Invalid file'], 400);
                }
            }

            // Save updated forum
            $forum->update([
                'title' => $request->title,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json(['message' => 'Forum berhasil diperbarui', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $forum = Forum::find($id);

            if (!$forum) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $forum->images->each(function ($image) {
                Storage::disk('public')->delete($image->gambar);
            });

            // Delete associated images
            $forum->images()->delete();

            // Delete the forum itself
            $forum->delete();

            return response()->json(['message' => 'Forum berhasil dihapus', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function comment_forum(Request $request, $forum_id)
    {
        try {
            $forumId = Forum::find($forum_id);

            if (!$forumId) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $request->validate([
                'komentar' => 'required|string',
                'forum_id' => 'required',
                'user_id' => 'required',
            ]);

            $forumKomen = KomentarForum::create([
                'komentar' => $request->komentar,
                'forum_id' => $forum_id,
                'user_id' => $request->user_id,
            ]);

            if ($forumKomen) {
                return response()->json([
                    'message' => 'Forum berhasil ditambahkan',
                    'status' => 'success',
                ], 200);
            } else {
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to comment forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function update_comment_forum(Request $request, $id)
    {
        try {
            $request->validate([
                'komentar' => 'required|string',
            ]);

            $forumKomen = KomentarForum::find($id);

            if(!$forumKomen){
                return response()->json(['message' => 'Komentar Forum not found', 'status' => 'error'], 404);
            }

            $forumKomen->update([
                'komentar' => $request->komentar,
            ]);

            return response()->json(['message' => 'Komentar Forum berhasil diperbarui', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memperbaharui Komentar Forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete_comment_forum($id)
    {
        try {
            $forumKomen = KomentarForum::find($id);

            if(!$forumKomen){
                return response()->json(['message' => 'Komentar Forum not found', 'status' => 'error'], 404);
            }

            $forumKomen->delete();

            return response()->json(['message' => 'Komentar Forum berhasil dihapus', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus Komentar Forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function get_comment_forum($forum_id)
    {
        try {
            $forumKomentar = KomentarForum::where('forum_id', $forum_id)->get();

            if (!$forumKomentar) {
                return response()->json(['message' => 'Komentar Forum not found', 'status' => 'error'], 404);
            }

            return response()->json(['data' => $forumKomentar, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function like_forum($forum_id, $user_id)
    {
        try {
            $forumId = Forum::find($forum_id);

            if (!$forumId) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            // $request->validate([
            //     'forum_id' => 'required|exists:forums,id', // Validasi tambahan
            //     'user_id' => 'required|exists:users,id', // Validasi tambahan
            // ]);

            $forumKomen = LikeForum::create([
                'like' => 1,
                'forum_id' => $forum_id,
                'user_id' => $user_id,
            ]);

            if ($forumKomen) {
                return response()->json([
                    'message' => 'Like berhasil ditambahkan',
                    'status' => 'success',
                ], 200);
            } else {
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memberikan like ke forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function dislike_forum(Request $request, $forum_id)
    {
        try {
            // $forumId = Forum::find($forum_id);

            if (!$forum_id) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $request->validate([
                'like' => 'required',
                'forum_id' => 'required',
            ]);

            $forumKomen = LikeForum::create([
                'like' => 2,
                'forum_id' => $forum_id,
            ]);

            if ($forumKomen) {
                return response()->json([
                    'message' => 'Like berhasil ditambahkan',
                    'status' => 'success',
                ], 200);
            } else {
                return response()->json(['message' => 'Gagal menambahkan data', 'status' => 'error', 'error' => 'Failed to save data to the database'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memberikan like ke forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
}
