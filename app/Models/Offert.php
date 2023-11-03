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
        'name', 
        'surname', 
        // 'voivodeship', 
        'city_id', 
        'company', 
        // 'profession', 
        'workplace', 
        'profile-picture', 
        'youtube', 'facebook', 'instagram', 'tiktok', 'twitter', 
        'description'
    ];
    public function scopeFilter($query, array $filters){
        // ddd($filters);
        if($filters['profession'] ?? false){ // not false
            $query->where('profession', 'like', '%'. request('profession') . '%');
        }

        if($filters['search'] ?? false){ // not false
            $query->where('voivodeship', 'like', '%'. request('search') . '%')
                  ->orWhere('city', 'like', '%'. request('search') . '%');
        }
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
}
