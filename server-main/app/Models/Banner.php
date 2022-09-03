<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];

    protected $fillable = [
        'title',
        'image',
        'status',
    ];

    protected function getImageUrlAttribute()
    {
        return url("banners").'/'.$this->attributes['image'];
    }
}
