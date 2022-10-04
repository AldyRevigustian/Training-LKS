<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplyPosition extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        "id",
        "date",
        "society_id",
        "job_vacancy_id",
        "position_id",
        "job_apply_societies_id",
        "status"
    ];
}
