<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'type',
        'title',
        'speaker',
        'start',
        'end',
        'room_id',
        'description'
    ];
}
