<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    protected $hidden = [
        'event_id',
        'special_validity'
    ];

    protected $appends = ['description', 'available'];

    public function getDescriptionAttribute(){
        if($this->special_validity == null)
            return null;

        $special_validity = json_decode($this->special_validity);

        if($special_validity->type == 'amount'){
            return $special_validity->amount . " Ticket Available";
        }else {
            return "Available Until " . date('F j, Y', strtotime($special_validity->date));
        }
    }

    public function getAvailableAttribute(){
        if($this->special_validity == null)
            return null;

        $special_validity = json_decode($this->special_validity);

        if ($special_validity->type == 'date'){
            if(date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($special_validity->date))){
                return false;
            };
            return true;
        }

        if($this->registrations()->count() > $special_validity->amount){
            return false;
        }

        return true;
    }


    public function registrations(){
        return $this->hasMany(Registration::class, 'ticket_id');
    }
}
