<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('admin.posts.edit', compact('post', 'users'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => ['nullable', 'file', 'max:3000', 'mimes:png,jpg,webp'],
            'user_id' => 'required|exists:users,id',
        ]);

        // update image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('post_images', $request->image);
        }

        // update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted.');
    }
}
