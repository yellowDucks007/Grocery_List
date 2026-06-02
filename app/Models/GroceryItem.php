<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroceryItem extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'quantity',
        'unit',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}