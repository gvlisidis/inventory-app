<?php

namespace App\Models;

use App\Enums\Group;
use App\Enums\Location;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'group' => Group::class,
        'location' => Location::class
    ];

    final public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    final public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    final public function prepareLocation(array $data): string
    {
        if (!$data['box_id']){
            return $data['location'];
        }

        if ($data['box_id'] !== $this->box_id){
            return  Box::find($data['box_id'])->location;
        }

        return $this->box->location;
    }
}
