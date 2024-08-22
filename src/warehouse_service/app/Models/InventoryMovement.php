<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'ingredient_id', 'quantity', 'movement_type'
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];
}
