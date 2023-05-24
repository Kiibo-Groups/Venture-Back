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

    public function getSigners()
    {
        return $this->hasMany('App\Models\BeaconsSign')->orderBy('created_at');
    }

    public function getAll()
    {
        return Beacons::where('status',1)->get();
    }
 
}
