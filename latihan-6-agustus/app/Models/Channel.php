<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $hidden = [
        'event_id'
    ];

    public function sessions(){
        return $this->hasManyThrough(Session::class, Room::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
