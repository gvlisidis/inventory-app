<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class);
    }
    public function boxItems(): HasManyThrough
    {
        return $this->hasManyThrough(Item::class, Box::class);
    }

    public function isTeamOwner()
    {
        if (!$this->team) {
            return false;
        }

        return $this->id === $this->team->owner_id;
    }
}
