<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Requests\UpdateBoxRequest;
use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    final public function index(): ResourceCollection
    {
        return BoxResource::collection(Box::all());
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
    public function store(StoreBoxRequest $request)
    {
        $box = Box::create($request->validated());

        $uri = url("/box/{$box->id}/contents");

        $box->uri = $uri;
        $box->save();

        return new BoxResource($box);
    }

    /**
     * Display the specified resource.
     */
    public function show(Box $box)
    {
        return new BoxResource($box->load('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoxRequest $request, Box $box)
    {
        //dd($request->all(), $box);
        $box->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return new BoxResource($box);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Box $box)
    {
        foreach ($box->items as $item) {
            $item->update([
                'location' => $box->location,
            ]);
        }

        $box->delete();

        return response()->noContent();
    }
}
