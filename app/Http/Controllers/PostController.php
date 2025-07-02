<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


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
        $request->validate([
            'caption' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'image_url' => $imagePath,
            'likes' => 0,
            'dislikes' => 0,
        ]);

        return response()->json($post, 201);
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
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Hapus gambar jika ada
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        $post->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
