<?php

namespace App\Models;

use App\Enums\Group;
use App\Enums\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
