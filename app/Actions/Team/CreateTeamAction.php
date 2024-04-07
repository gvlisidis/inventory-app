<?php

namespace App\Actions\Team;

use App\Models\Team;

class CreateTeamAction
{
    public function create(string $data): Team
    {
        return Team::create([
            'name' => $data,
        ]);
    }
}
