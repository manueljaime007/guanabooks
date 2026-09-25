<?php

namespace App\Enums;

enum MediaType: string
{
    case THUMBNAIL = 'thumbnail';
    case COVER = 'cover';
    case PDF = 'pdf';
    case ICON = 'icon';
    case CONTENT_IMAGE = 'content_image';
    case ATTACHMENT = 'attachment';
}
