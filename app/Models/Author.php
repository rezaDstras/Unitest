<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded=[];

    //protected_at and updated at is instance of carbon as a default
    //now add dateOfBirth to Carbon
    protected $dates =['dateOfBirth'];

    //set dateOfBirth request
    public function setDateOfBirthAttribute($dateOfBirth)
    {
        $this->attributes['dateOfBirth']=Carbon::parse($dateOfBirth);
    }
}
