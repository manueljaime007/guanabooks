<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct(private FileUploadService $uploadService) {}

    public function index()
    {
        $books = BookResource::collection(Book::all());
        return response()->json([$books], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $pdfUrl = $this->uploadService->upload(
            $request->file('pdf'),
            'pdf'
        );

        $data['user_id'] = $request->user()->id;

        $thumbnailUrl = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailUrl = $this->uploadService->upload(
                $request->file('thumbnail'),
                'thumbnail'
            );
        }

        $book = Book::create([
            ...$data,
            'pdf_url' => $pdfUrl,
            'thumbnail_url' => $thumbnailUrl,
            'status' => $data['status'] ?? 'draft',
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([
            new BookResource($book)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // usar policy quando houver mais de um user que cadastra
        // por enquanto é só o admin. Então não

        $data = $request->validated();
        // Se novo PDF, remover antigo e fazer upload

        if ($request->hasFile('pdf')) {
            $this->uploadService->delete($book->pdf_url, 'pdf');
            $book->pdf_url = $this->uploadService->upload(
                $request->file('pdf'),
                'pdf'
            );
        }

        // Se novo Thumbnail, remover antigo e fazer upload
        if ($request->hasFile('thumbnail')) {
            if ($book->thumbnail_url) {
                $this->uploadService->delete($book->thumbnail_url, 'thumbnail');
            }
            $book->thumbnail_url = $this->uploadService->upload(
                $request->file('thumbnail'),
                'thumbnail'
            );
        }

        $book->update($data);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // o mesmo caso da policy

        $this->uploadService->delete($book->pdf_url, 'pdf');
        if ($book->thumbnail_url) {
            $this->uploadService->delete($book->thumbnail_url, 'thumbnail');
        }

        $book->delete();

        return response()->noContent();
    }
}
