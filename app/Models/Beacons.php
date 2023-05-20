<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beacons extends Model
{
    use HasFactory;
    protected $table = 'beacons'; 

    protected $fillable =[
        'descript',
        'uuid',
        'status'
    ];
 
}
