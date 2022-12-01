<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;


    public $timestamps = false;
    
    protected $fillable = [
        "id",
        "job_category_id",
        "society_id",
        "validator_id",
        "status",
        "work_experience",
        "job_position",
        "reason_accepted",
        "validator_notes"
    ];
}
