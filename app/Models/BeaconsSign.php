<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeaconsSign extends Model
{
    use HasFactory;
    protected $table = 'beacons_sing_users'; 

    protected $fillable =[
        'user_id',
        'beacons_id'
    ];
 
 
}
