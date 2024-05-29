<?php

namespace App\Http\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KomentarForum;
use App\Models\ReplyKomentar;

class ReplyKomentarController extends Controller
{
    public function reply(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'forum_id' => 'required|exists:forums,id',
            'komentar_id' => 'required|exists:forum_komentars,id',
            'komentar' => 'required|string',
        ]);

        $parentComment = KomentarForum::find($request->komentar_id);
        if (!$parentComment) {
            return response()->json(['message' => 'Komentar tidak ditemukan', 'status' => 'error'], 404);
        }

        $replyComment = ReplyKomentar::create([
            'user_id' => $request->user_id,
            'forum_id' => $request->forum_id,
            'komentar_id' => $request->komentar_id,
            'komentar' => $request->komentar,
        ]);

        return response()->json([
            'message' => 'Reply berhasil ditambahkan',
            'status' => 'success',
            'data' => $replyComment,
        ], 201);
    }

    public function getRepliesByUserId($userId)
    {
        $replies = ReplyKomentar::whereHas('comment', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['user', 'comment', 'forum'])->get();

        return response()->json([
            'message' => 'Berhasil mengambil data reply komentar',
            'status' => 'success',
            'data' => $replies,
        ], 200);
    }
}
