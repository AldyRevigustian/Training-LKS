<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "job_category_id",
        "company",
        "address",
        "description",
    ];

    public function category(){
        return $this->hasOne(JobCategory::class, 'id', 'job_category_id');
    }

    public function positions(){
        return $this->hasMany(AvailablePosition::class,);
    }

}
