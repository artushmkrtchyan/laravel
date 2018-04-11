<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    public $table = 'contact_us';
    public $fillable = ['last_name','first_name','email','message'];

}
