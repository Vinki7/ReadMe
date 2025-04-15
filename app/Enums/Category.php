<?php

namespace App\Enums;

enum Category
{
    case Fantasy = 'fantasy';
    case SciFi = 'sci-fi';
    case Mystery = 'mystery';
    case Romance = 'romance';
    case Horror = 'horror';
    case NonFiction = 'non-fiction';
    case Biography = 'biography';
    case SelfHelp = 'self_help';
    case Education = 'education';
    case Fitness = 'fitness';
    case Psychology = 'psychology';
    case Adults = 'adults';
}
