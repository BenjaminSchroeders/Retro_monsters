<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'type_id', 'rarity_id', 'pv', 'attack', 'image_url', 'description', 'defense'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsTo(Monster_type::class, 'type_id');
    }

    public function rarety()
    {
        return $this->belongsTo(Rarety::class, 'rarety_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'monster_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'monster_id');
    }

    public function notations()
    {
        return $this->hasMany(Notation::class, 'monster_id');
    }
}