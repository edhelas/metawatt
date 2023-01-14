<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    function getTitleAttribute(): string
    {
        return catName($this->key);
    }

    function getColorAttribute(): string
    {
        return catColor($this->key);
    }

    function getDarkerColorAttribute(): string
    {
        return catColor($this->key, 0.7);
    }
}
