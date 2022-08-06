<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    public function registration(){
        return $this->hasMany(EventTicket::class. 'ticket_id', 'id');
    }
}
