<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $posts = PostResource::collection(Post::all());
        return response()->json([
            'message' => 'Listing $posts',
            'data' => $posts,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }


    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $post->update($data);

        return response()->json([
            "message" => "Post updated sucessfully!",
            "data" => $data
        ], 200);
    }


    public function destroy(Post $post) {}
}
