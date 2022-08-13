<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public $timestamps  = false;

    protected $fillable = [
        'ticket_id',
        'attendee_id'
    ];


    public function event(){
        return $this->belongsTo(Event::class);
    }
    public function session_registrations(){
        return $this->hasMany(SessionRegistration::class);
    }
}
