<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\BookCategory;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{

    public function index()
    {

        return PostCategory::all();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:3'],
        ]);

        $data['slug'] = Str::slug($request->name);

        PostCategory::create($data);
        return response()->json([
            'message' => 'Categoria de Post criada com sucesso',
            'data' => $data
        ], 201);
    }


    public function show(BookCategory $bookCategory)
    {
        return response()->json([
            'data' => $bookCategory
        ]);
    }


    public function update(Request $request, BookCategory $bookCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:3'],
        ]);

        $bookCategory->update($data);

        return response()->noContent();
    }


    public function destroy(BookCategory $bookCategory)
    {
        //
    }
}
