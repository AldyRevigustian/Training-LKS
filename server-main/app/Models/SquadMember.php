<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadMember extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];
    protected $fillable = [
        'squad_id',
        'name',
        'phone',
        'dob',
        'role',
        'picture',
        'email',
    ];
    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }
    protected function getImageUrlAttribute()
    {
        return url("squad-members") . '/' . $this->attributes['picture'];
    }
}
