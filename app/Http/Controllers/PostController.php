<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Article;
use App\Models\Category;

class PostController extends Controller
{
    public function index() {
        $posts = Article::with('category')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    public function create() {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request) {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public/images');
        }
        Article::create($validated);
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Article $post) {
        return view('posts.show', compact('post'));
    }

    public function edit(Article $post) {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(StorePostRequest $request, Article $post) {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            unlink(storage_path('app/' . $post->image));
            $validated['image'] = $request->file('image')->store('public/images');
        }
        $post->update($validated);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Article $post) {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
