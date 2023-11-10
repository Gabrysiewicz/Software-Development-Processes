<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        // 'voivodeship', 
        'city_id', 
        'company', 
        // 'profession', 
        // 'workplace', 
        'profile_picture', 
        'youtube', 'facebook', 'instagram', 'tiktok', 'twitter', 
        'description'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->select('offerts.*')
            ->join('cities', 'offerts.city_id', '=', 'cities.id')
            ->groupBy('offerts.id');

        if ($filters['profession']) {
            $query->join('offert_profession', 'offerts.id', '=', 'offert_profession.offert_id')
                ->join('professions', 'offert_profession.profession_id', '=', 'professions.id')
                ->where('professions.name', 'like', '%' . $filters['profession'] . '%');
        }
    
        if ($filters['city']) {
            $query->where('cities.name', 'like', '%' . $filters['city'] . '%');
        }
    
        return $query;
    }

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }
    public function city(){
        return $this->belongsTo(City::class, "city_id");
    }
    public function professions()
    {
        return $this->belongsToMany(Profession::class);
    }
    public function workplaces()
    {
        return $this->belongsToMany(Workplace::class);
    }
}
