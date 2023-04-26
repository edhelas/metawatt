<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    use HasFactory;

    public function data()
    {
        return $this->hasMany(Data::class);
    }

    public function getGoalsAttribute()
    {
        return unserialize($this->attributes['goals']);
    }

    public function previous()
    {
        return Scenario::where('id', '<', $this->attributes['id'])->orderBy('id', 'desc')->first();
    }

    public function next()
    {
        return Scenario::where('id', '>', $this->attributes['id'])->orderBy('id', 'asc')->first();
    }

    public function evolutionCapacity(string $category, int $year = 2050): float
    {
        $futur = $this->data()->whereIn('category_id', function($query) use ($category) {
            $query->select('id')->from('categories')->where('key', $category);
        })->where('year', $year)->first();

        $now = $this->data()->whereIn('category_id', function($query) use ($category) {
            $query->select('id')->from('categories')->where('key', $category);
        })->where('year', 2020)->first();

        return ($futur ? $futur->capacity : 0) - ($now ? $now->capacity: 0);
    }
}
