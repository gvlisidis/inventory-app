<?php

namespace App\Http\Controllers\API;

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
        $item = Item::create([
            'name' => $request->name,
            'box_id' => $request->box_id,
            'location' => $request->location,
            'group' => $request->group,
            'description' => $request->description,
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
        $item->update([
            'name' => $request->name,
            'group' => $request->group,
            'box_id' => $request->box_id,
            'location' => $this->prepareLocation($request, $item),
            'description' => $request->description,
        ]);

        return new ItemResource($item);
    }

    private function prepareLocation(UpdateItemRequest $request, Item $item): string
    {
        if (!$request->box_id){
            return $request->location;
        }

        if ($request->box_id !== $item->box_id){
            return  Box::find($request->box_id)->location;
        }

        return $item->box->location;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
