<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['category', 'tags', 'author'])
            ->withCount(['likes', 'comments'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(15);


        return response()->json([
            'data' => PostResource::collection($posts),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    public function show(String $slug)
    {
        $post = Post::with(['category', 'tags', 'author'])
            ->withCount(['likes', 'comments'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Incrementar views
        $post->increment('views');

        return response()->json([
            'data' => new PostResource($post)
        ]);
    }


    public function like(Post $post, Request $request)
    {
        $user = $request->user();

        if ($post->likedByUser($user->id)) {
            return response()->json([
                "message" => "You have already liked this post"
            ], 422);
        }

        DB::transaction(function () use ($post, $user) {
            $post->likes()->attach($user->id);
            $post->increment('likes');
        });


        // Retorna resposta
        return response()->json([
            "message" => "Post liked successfully",
            "likes" => $post->likes
        ], 200);
    }

    public function unlike(Post $post, Request $request)
    {
        $user = $request->user();

        if (!$post->likedByUser($user->id)) {
            return response()->json([
                "message" => "You haven't liked this post yet"  // ✅ Mensagem corrigida
            ], 422);
        }

        DB::transaction(function () use ($post, $user) {
            $post->likes()->detach($user->id);
            $post->decrement('likes');
        });

        return response()->json([
            "message" => "Post unliked successfully",
            "likes" => $post->likes
        ], 200);
    }
}
