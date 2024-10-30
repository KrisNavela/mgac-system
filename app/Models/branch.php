<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class branch extends Model
{
    use HasFactory;

    protected $fillable = [

        'branch_code',
        'branch_name',
        'manager_name',
        'manager_position',
        'address1',
        'address2',
        'type_office',

    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function requisitionusers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Requisition::class, 'branch_id', 'user_id');
    }
}
