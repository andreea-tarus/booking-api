<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'trip_slug',
            'arrival_date',
            'nights',
        ];

    public function getUserId() :int
    {
        return $this->user_id;
    }

    public function setUserId($user_id) 
    {
        $this->user_id = $user_id;
    }

    public function getTripSlug() :string
    {
        return $this->trip_slug;
    }

    public function setTripSlug($trip_slug) 
    {
        $this->trip_slug = $trip_slug;
    }

    public function getArrivalDate()
    {
        return $this->arrival_date;
    }

    public function setArrivalDate($arrival_date) 
    {
        $this->arrival_date = $arrival_date;
    }

    public function getNights() :int 
    {
        return $this->nights;
    }

    public function setNights($nights) 
    {
        $this->nights = $nights;
    }
}
