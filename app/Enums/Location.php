<?php

namespace App\Enums;

enum Location: string
{
    case GARAGE = 'Garage';
    case UNDER_STAIRS_WARDROBE = 'Under Stairs Wardrobe';
    case UNDER_STAIRS_1 = 'Under Stairs 1';
    case UNDER_STAIRS_2 = 'Under Stairs 2';
    case PARENTS_WARDROBE = 'Parents Wardrobe';
    case KLEIO_WARDROBE = 'Kleio Wardrobe';
    case ANESTIS_WARDROBE = 'Anestis Wardrobe';
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
