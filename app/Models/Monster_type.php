<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster_type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function monsters()
    {
        return $this->hasMany(Monster::class, 'type_id');
    }
}