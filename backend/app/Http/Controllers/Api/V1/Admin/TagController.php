<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'data' => TagResource::collection($tags)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3'],
        ]);

        $data['slug'] = Str::slug($data['name']);

        $tag = Tag::create($data);

        return response()->json([
            'data' => new TagResource($tag)
        ]);
    }

    /**
     * Display the specified resource.
     */

    public function show(Tag $tag)
    {
        return response()->json([
            'data' => new TagResource($tag)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => ['string', 'min:3'],
        ]);

        if ($request->has('name') && $request->name !== $tag->name) {
            $data['slug'] = Str::slug($request->name);
        }

        $tag->update($data);

        return response()->json([
            'message' => 'Tag atualizada com sucesso',
            'data' => new TagResource($tag)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // Verificar se tem posts antes de deletar
        if ($tag->posts()->exists()) {
            return response()->json([
                'message' => 'Não é possível deletar uma tag que está sendo usada'
            ], 422);
        }

        $tag->delete();

        return response()->json([
            'message' => 'Tag deletada com sucesso'
        ], 200);
    }
}
