<?php

namespace App\Models;

use App\Http\Traits\WithQuerySearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, WithQuerySearch;

    public function scopeGetSystemCities($query)
    {
        return $query->whereIn('country_id', [233,/* 233,239,31,39,75 */]);
    }
}
