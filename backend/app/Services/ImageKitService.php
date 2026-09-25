<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    private ImageKit $client;

    public function __construct()
    {

        $this->client = new ImageKit(
            config('services.imagekit.public_key'),
            config('services.imagekit.private_key'),
            config('services.imagekit.url_endpoint'),
        );
    }

    public function client(): ImageKit
    {
        return $this->client;
    }
}
