<?php

namespace App\Enums;

enum PostBlockType: string
{
    case RICH_TEXT = 'rich_text';
    case IMAGE = 'image';
    case CODE = 'code';
    case QUOTE = 'quote';
    case LINK = 'link';
    case EMBED = 'embed';
    case FILE = 'file';
}
