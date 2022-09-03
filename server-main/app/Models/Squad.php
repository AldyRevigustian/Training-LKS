<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];
    protected $fillable = [
        'logo',
        'name',
        'description',
        'achievements',
    ];
    protected function getImageUrlAttribute()
    {
        return url("squads") . '/' . $this->attributes['logo'];
    }
    public function members() {
        return $this->hasMany(SquadMember::class);
    }
}
