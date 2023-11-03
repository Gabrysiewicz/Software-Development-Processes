<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'voivodeship_id'];

    public function voivodeship()
    {
        return $this->belongsTo(Voivodeship::class, 'voivodeship_id');
    }

    public function offerts()
    {
        return $this->hasMany(Offert::class, 'city_id');
    }
}
