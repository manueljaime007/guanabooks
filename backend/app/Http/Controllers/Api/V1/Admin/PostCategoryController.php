<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoryPostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Http\Resources\PostCategoryResource;
use App\Http\Resources\PostResource;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{

    public function index()
    {
        $categories = PostCategory::all();
        // return PostCategory::all();
        return response()->json([
            'data' => PostCategoryResource::collection($categories)
        ]);
    }


    public function store(StoryPostCategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $category = PostCategory::create($data);
        return response()->json([
            'message' => 'Categoria de Post criada com sucesso',
            'data' => new PostCategoryResource($category)
        ], 201);
    }


    public function show(PostCategory $postCategory)
    {
        return response()->json([
            'data' => new PostCategoryResource($postCategory)
        ]);
    }


    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        $data = $request->validated();

        $postCategory->update($data);

        return response()->noContent();
    }


    public function destroy(PostCategory $postCategory) // <-- CORRIGIDO
    {
        if ($postCategory->posts()->exists()) {
            return response()->json([
                'message' => 'Não é possível deletar uma categoria que possui posts'
            ], 422);
        }

        $postCategory->delete();

        return response()->json([
            'message' => 'Categoria deletada com sucesso'
        ], 200);
    }
}
