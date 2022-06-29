<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
