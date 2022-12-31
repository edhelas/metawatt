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

    public function scopeNoStorage($query)
    {
        return $query->whereNotIn('category_id', function ($query) {
            $query->select('id')
                  ->from('categories')
                  ->whereIn('key', storage());
        });
    }

    public function scopeRenewable($query)
    {
        return $query->whereIn('category_id', function ($query) {
            $query->select('id')
                  ->from('categories')
                  ->whereIn('key', renewable());
        });
    }

    public function scopeLowCarbon($query)
    {
        return $query->whereIn('category_id', function ($query) {
            $query->select('id')
                  ->from('categories')
                  ->whereIn('key', lowCarbon());
        });
    }

    public function scopeNoFinal($query)
    {
        return $query->whereNotIn('category_id', function ($query) {
            $query->select('id')
                  ->from('categories')
                  ->where('key', 'final');
        });
    }
}
