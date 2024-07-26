<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Post;

class PostController extends Controller
{
    // This method use to show list of posts
    public function index() {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // This method use to store post
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }
    
    // This method is use to update the post
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }
    
    // This method is use to delete the post
    public function destroy($id) {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
  
    // This method is use to show post add page
    public function create() {
        return view('posts.create');
    }
  
    // This method is use to show list of posts
    public function show($id) {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    // This method is use to show edit page of post
    public function edit($id) {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }
}
