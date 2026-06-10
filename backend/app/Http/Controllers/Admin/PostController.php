<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        return Post::all();
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        Post::create($data);

        return response()->json([
            "message" => "Post created sucessfully!",
            "data" => $data
        ], 201);
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


    public function destroy(Post $post)
    {
        //
    }
}
