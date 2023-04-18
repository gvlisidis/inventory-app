<?php

namespace App\Enums;

enum Group: string
{
    case GARDEN = 'Garden';
    case HAND_TOOLS = 'Hand Tools';
    case TOYS = 'Toys';
    case SCREEN_CABLES = 'Screen Cables';
    case ELECTRICAL = 'Electrical';
    case CRAFTS = 'Crafts';
    case CHRISTMAS = 'Cristmas';
    case EASTER = 'Easter';
    case HALLOWEEN = 'Halloween';
    case TILES = 'Tiles';
    case WOOD_TREATMENT = 'Wood Treatment';

    public static function getAllValues(): array
    {
        return array_column(Group::cases(), 'value');
    }
}
