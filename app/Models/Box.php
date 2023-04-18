<?php

namespace App\Models;

use App\Enums\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Box extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    final public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
