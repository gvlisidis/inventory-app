<?php

namespace App\Enums;

enum Location: string
{
    case GARAGE = 'Garage';
    case UNDER_STAIRS = 'Under Stairs';
    case PARENTS_WORDROBE = 'Parents Wordrobe';
    case KLEIO_WORDROBE = 'Kleio Wordrobe';
    case ANESTIS_WORDROBE = 'Anestis Wordrobe';
    case STUDY_BOOKSHELVES = 'Study Bookshelves';
    case GUEST_ROOM = 'Guest Room';
    case GARDEN_SHED = 'Garden Shed';
    case KITCHEN_SIDEBOARD = 'Kitchen Sideboard';
    case KITCHEN_CORNER_CABINET = 'Kitchen Corner Cabinet';
    case SMALL_BATHROOM = 'Small Bathroom';
    case MAIN_BATHROOM = 'Main Bathroom';
    case EN_SUITE = 'En Suite';
    case STUDY_DESK = 'Study Desk';

    public static function getAllValues(): array
    {
        return array_column(Location::cases(), 'value');
    }
}
