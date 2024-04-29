<?php

namespace App\Actions\Item;

use App\Actions\Box\GetBoxesAction;
use App\Models\Item;
use Illuminate\Support\Collection;

class GetItemsAction
{
    final public function getItems(?string $searchTerm): Collection
    {
        $user = auth()->user();
        $team = $user->team;
        $boxIds = app(GetBoxesAction::class)->getBoxes($team)->pluck('id');

        return Item::query()
            ->whereIn('box_id', $boxIds)
            ->when($searchTerm, function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })->when(!$team, function ($query) use ($user) {
                $query->orWhere(function ($query) use ($user) {
                    $query->whereNotNull('user_id')
                        ->where('user_id', $user->id);
                });
            })->get();
    }
}