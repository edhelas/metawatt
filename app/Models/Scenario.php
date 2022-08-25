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

    public function previous()
    {
        return Scenario::where('id', '<', $this->attributes['id'])->orderBy('id', 'desc')->first();
    }

    public function next()
    {
        return Scenario::where('id', '>', $this->attributes['id'])->orderBy('id', 'asc')->first();
    }
}
