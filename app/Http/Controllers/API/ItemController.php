<?php

namespace App\Http\Controllers\API;

use App\Actions\Box\GetBoxesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Box;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::query()->orderBy('box_id', 'asc')->get();

        return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

        $item = Item::create([
            'name' => $validated['name'],
            'group' => $validated['group'],
            'box_id' => $validated['box_id'],
            'location' => $validated['location'],
            'description' => $validated['description'],
        ]);

        return new ItemResource($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $validated = $request->validated();

        $item->update([
            'name' => $validated['name'],
            'group' => $validated['group'],
            'box_id' => $validated['box_id'],
            'location' => $item->prepareLocation($validated),
            'description' => $validated['description'],
        ]);

        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
