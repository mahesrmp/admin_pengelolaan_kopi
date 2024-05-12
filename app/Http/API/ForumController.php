<?php

namespace App\Http\API;

use App\Models\Forum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KomentarForum;
use App\Models\LikeForum;

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
                $gambar = null;
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
            $request->validate([
                'title' => 'required|string',
                'deskripsi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id' => 'required',
            ]);

            $forum = Forum::find($id);

            if (!$forum) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $forum->title = $request->title;
            $forum->deskripsi = $request->deskripsi;
            $forum->user_id = $request->user_id;

            if ($request->hasFile('gambar')) {
                $uploadedFile = $request->file('gambar');
                if ($uploadedFile->isValid()) {
                    $gambarPath = $uploadedFile->store('forumimage', 'public');

                    if ($forum->images()->exists()) {
                        // Assuming an article can have only one image
                        $forum->images()->first()->delete();
                    }

                    // Menambahkan gambar baru
                    $forum->images()->create(['gambar' => $gambarPath]);
                }
            } else {
                return response()->json(['message' => 'Gagal mengunggah Gambar', 'status' => 'error', 'error' => 'Invalid file'], 400);
            }

            // Save updated forum
            $forum->save();

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

            // Delete associated images
            $forum->images()->delete();

            // Delete the forum itself
            $forum->delete();

            return response()->json(['message' => 'Forum berhasil dihapus', 'status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete forum', 'status' => 'error', 'error' => $e->getMessage()], 500);
        }
    }

    public function comment_forum(Request $request, $id)
    {
        try {
            $forumId = Forum::find($id);

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
                'forum_id' => $forumId,
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

    public function like_forum(Request $request, $id)
    {
        try {
            $forumId = Forum::find($id);

            if (!$forumId) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $request->validate([
                'like' => 'required',
                'forum_id' => 'required',
            ]);

            $forumKomen = LikeForum::create([
                'like' => 1,
                'forum_id' => $forumId,
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

    public function dislike_forum(Request $request, $id)
    {
        try {
            $forumId = Forum::find($id);

            if (!$forumId) {
                return response()->json(['message' => 'Forum not found', 'status' => 'error'], 404);
            }

            $request->validate([
                'like' => 'required',
                'forum_id' => 'required',
            ]);

            $forumKomen = LikeForum::create([
                'like' => 2,
                'forum_id' => $forumId,
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
