<?php

namespace App\Models;

use App\Http\Traits\WithQuerySearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, WithQuerySearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'iso2',
        'iso3',
        'numeric_code',
        'phone_code',
        'currency',
        'currency_name',
        'currency_symbol',
        'native',
        'region',
        'emoji',
        'emojiU'
    ];
}
