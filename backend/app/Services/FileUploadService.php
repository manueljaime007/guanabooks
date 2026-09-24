<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    private array $paths = [
        'thumbnail' => 'thumbnails',
        'cover' => 'covers',
        'pdf' => 'books/pdf',
        'icon' => 'icons',
    ];

    public function upload(UploadedFile $file, string $type): string
    {
        if (! isset($this->paths[$type])) {
            throw new \InvalidArgumentException(
                "Tipo inválido: {$type}"
            );
        }

        $filename = Str::random(12)
            . '.'
            . $file->getClientOriginalExtension();

        return $file->storeAs(
            $this->paths[$type],
            $filename,
            'public'
        );
    }

    public function delete(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}
