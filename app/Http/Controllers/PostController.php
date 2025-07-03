<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    // Tampilkan semua postingan
    public function index()
    {
        return Post::with('user')->latest()->get();
    }

    // Buat postingan baru (dengan gambar)
    public function store(Request $request)
    {
        try {
            $request->validate([
                'caption' => 'required|string|max:1000',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
    
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }
    
            $post = Post::create([
                'user_id' => auth("sanctum")->user->id,
                'caption' => $request->caption,
                'image_url' => $imagePath,
                'likes' => 0,
                'dislikes' => 0,
            ]);
    
            return response()->json($post, 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    // Tambah Like
    public function like(Post $post)
    {
        $post->increment('likes');
        return response()->json(['likes' => $post->likes]);
    }

    // Tambah Dislike
    public function dislike(Post $post)
    {
        $post->increment('dislikes');
        return response()->json(['dislikes' => $post->dislikes]);
    }

    // Hapus postingan
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth("sanctum")->user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Hapus gambar jika ada
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        $post->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function report(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        // Buat Report baru (bisa tambah kolom alasan)
        $report = Report::create([
            'reason' => $request->input('reason')
        ]);

        // Attach ke post
        $post->reports()->attach($report->id);

        // Hitung total report untuk post ini
        $totalReports = $post->reports()->count();

        // Jika lebih dari 50, hapus post
        if ($totalReports > 50) {
            $post->delete();
            return response()->json(['message' => 'Post deleted due to excessive reports'], 200);
        }

        return response()->json(['message' => 'Post reported successfully', 'total_reports' => $totalReports], 200);
    }
}
