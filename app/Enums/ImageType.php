<?php

namespace App\Enums;

enum ImageType: string
{
    case FrontCover = 'front_cover';
    case BackCover = 'back_cover';
    case FullBook = 'full_book';
    case BookInsights = 'book_insights';
    case Other = 'other';
}

