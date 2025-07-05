<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);
        
            $user = $request->user(); // ✅ Fix user access
        
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }
        
            $post = Post::create([
                'user_id' => $user->id, // ✅ Fix here too
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
    public function incLike(Post $post)
    {
        $post->increment('likes');
        return response()->json(['likes' => $post->likes]);
    }

    // Tambah Dislike
    public function incDislike(Post $post)
    {
        $post->increment('dislikes');
        return response()->json(['dislikes' => $post->dislikes]);
    }

    public function decLike(Post $post)
    {
        $post->decrement('likes');
        return response()->json(['likes' => $post->likes]);
    }

    // Tambah Dislike
    public function decDislike(Post $post)
    {
        $post->decrement('dislikes');
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

    public function report(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'report_id' => 'required|exists:reports,id',
        ]);
    
        $post = Post::findOrFail($request->post_id);
        $reportId = $request->report_id;
    
        $alreadyReported = DB::table('post_report')
            ->where('post_id', $post->id)
            ->where('report_id', $reportId)
            ->exists();
    
        if (!$alreadyReported) {
            // Masukkan ke pivot table
            $post->reports()->attach($reportId);
        }
    
        $totalReports = DB::table('post_report')
            ->where('post_id', $post->id)
            ->count();
    
        // Jika sudah 50 atau lebih, hapus post
        if ($totalReports >= 50) {
            $post->delete();
    
            return response()->json([
                'message' => 'Post deleted due to reaching 50 or more reports.',
                'total_reports' => $totalReports
            ]);
        }
    
        return response()->json([
            'message' => 'Report submitted successfully.',
            'total_reports' => $totalReports
        ]);
    }
}
