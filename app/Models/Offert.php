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
        'voivodeship', 
        'city', 
        'company', 
        'profession', 
        'workplace', 
        'profile-picture', 
        'youtube', 'facebook', 'instagrem', 'tiktok', 'twitter', 
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }}
