<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();
        return response()->json([
            'message' => 'Posts retrieved successfully',
            'data' => PostResource::collection($articles)
        ], 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'user_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $validateData['image'] = $request->file('image')->store('public/images');
        } else {
            $validateData['image'] = null;
        }
        $article = Article::create($validateData);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $article
        ], 201);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            return response()->json([
                'message' => 'Post not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'message' => 'Post found',
            'data' => new PostResource($article)
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'max:255',
            'category_id' => 'integer',
            'content' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        
        $article = Article::find($id);
        if (is_null($article)) {
            return response()->json([
                'message' => 'Post not found',
                'data' => null
            ], 404);
        }
        $article->update($request->all());
        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $article
        ], 200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            return response()->json([
                'message' => 'Post not found',
                'data' => null
            ], 404);
        }
        $article->delete();
        return response()->json([
            'message' => 'Post deleted successfully',
            'data' => $article
        ], 200);
    }
}
