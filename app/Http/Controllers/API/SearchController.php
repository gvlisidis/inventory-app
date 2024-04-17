<?php

namespace App\Http\Controllers\API;

use App\Actions\Box\GetBoxesAction;
use App\Actions\Item\GetItemsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $items = app(GetItemsAction::class)->getItems($request->searchTerm);

        return ItemResource::collection($items);
    }
}
