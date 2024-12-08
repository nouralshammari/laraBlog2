<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): RedirectResponse
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();

        $post = Post::create($incomingFields);


        return redirect('/dashboard')->with('status', 'Post created successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


        // Zoek de post en controleer eigenaarschap
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();


        // Log succes
//        Log::info('Post found for editing', ['post_id' => $post->id, 'title' => $post->title]);
        return view('posts/edit-post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post, $id)
    {
        // Zoek de post op en controleer eigenaarschap
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$post) {
            Log::warning('Unauthorized update attempt', ['post_id' => $id, 'user_id' => auth()->id()]);
            abort(404, 'Post not found or unauthorized access');
        }

        // Valideer de invoer
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Update de post
        $post->update([
            'title' => strip_tags($validatedData['title']),
            'description' => strip_tags($validatedData['description']),
        ]);


        return redirect('/dashboard')->with('status', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/dashboard')->with('status', 'Post deleted successfully!');
    }
}
