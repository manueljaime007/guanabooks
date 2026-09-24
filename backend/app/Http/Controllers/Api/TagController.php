<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;


class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'data' => TagResource::collection($tags)
        ]);
    }


    public function show(Tag $tag)
    {
        return response()->json([
            'data' => new TagResource($tag)
        ]);
    }
}
