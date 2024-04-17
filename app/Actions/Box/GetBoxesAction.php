<?php

namespace App\Actions\Box;

use App\Models\Team;
use Illuminate\Support\Collection;

class GetBoxesAction
{
    final public function getBoxes(?Team $team): Collection
    {
        return $team ? $team->boxes : auth()->user()->boxes;
    }
}
