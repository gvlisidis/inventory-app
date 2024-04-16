<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Team extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class);
    }

     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function boxItems(): HasManyThrough
    {
        return $this->hasManyThrough(Item::class, Box::class);
    }
}
