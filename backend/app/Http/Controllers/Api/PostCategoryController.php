<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCategoryResource;
use App\Models\PostCategory;

class PostCategoryController extends Controller
{

    public function index()
    {
        $categories = PostCategory::all();
        return response()->json([
            'data' => PostCategoryResource::collection($categories)
        ]);
    }

    public function show(PostCategory $postCategory)
    {
        return response()->json([
            'data' => new PostCategoryResource($postCategory)
        ]);
    }
}
