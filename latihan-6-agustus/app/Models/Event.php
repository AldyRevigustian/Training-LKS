<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function tickets(){
        return $this->hasMany(EventTicket::class, 'event_id', 'id');
    }

    public function registrations(){
        return $this->hasManyThrough(Registration::class, EventTicket::class, 'event_id', 'ticket_id');
    }

    public function rooms(){
        return $this->hasManyThrough(Room::class, Channel::class);
    }

    public function channels(){
        return $this->hasMany(Channel::class);
    }



}
