<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\FileUploadService;

class PostController extends Controller
{

    public function __construct(private FileUploadService $uploadService) {}

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

    public function store(StorePostRequest $request)
    {

        return response()->json([
            'hasFile' => $request->hasFile('thumbnail'),
            'file' => $request->file('thumbnail')?->getClientOriginalName(),
        ]);

        $data = $request->validated();

        if ($request->hasFile('thumbnail_url')) {

            $path = $this->uploadService->upload(
                $request->file('thumbnail_url'),
                'thumbnail'
            );

            $data['thumbnail_url'] = asset(
                'storage/' . $path
            );
        }

        $data['user_id'] = $request->user()->id;

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post criado com sucesso!',
            'data' => new PostResource($post->load([
                'author',
                'category',
                'tags'
            ]))
        ], 201);
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



    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail_url) {
                $this->uploadService->delete($post->thumbnail_url, 'thumbnail');
            }
            $post->thumbnail_url = $this->uploadService->upload(
                $request->file('thumbnail'),
                'thumbnail'
            );
        }

        $post->update($data);

        return response()->json([
            'data' => new PostResource($post)
        ]);
    }


    public function destroy(Post $post)
    {

        if ($post->thumbnail_url) {
            $this->uploadService->delete($post->thumbnail_url, 'thumbnail');
        }

        $post->delete();
        return response()->noContent();
    }
}
