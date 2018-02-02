<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    
    protected $table = 'events';

    protected $fillable = [

    	'description',
        'local',
        'locutor',
        'e_date',
        'e_time',
        'user_id',
        'updated_at'

    ];

}