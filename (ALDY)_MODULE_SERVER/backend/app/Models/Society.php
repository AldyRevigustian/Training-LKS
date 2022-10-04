<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'id_card_number',
        'name',
        'born_date',
        'gender',
        'address',
        'regional_id',
        'login_tokens'
    ];

    public function regional(){
        return $this->hasOne(Regional::class,'id', 'regional_id');
    }

    public function validation(){
        return $this->hasOne(Validation::class,'society_id', 'id');
        
    }

    public function jobSocieties(){
        return $this->hasOne(JobApplySocieties::class, 'society_id', 'id');
    }
}
