<?php

namespace App\Enums;

enum DeliveryMethod
{
    case Standard = 'standard';
    case Express = 'express';
    case Overnight = 'overnight';
    case SameDay = 'same_day';
    case Pickup = 'pickup';
    case InStorePickup = 'in_store_pickup';
}
