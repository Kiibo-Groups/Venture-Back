<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DOMDocument;
class ValueConn extends Model
{
    use HasFactory;
    protected $table = 'value_conn'; 

    protected $fillable =[
       'external_id',
       'app_user_id',
       'user_to',
       'rate',
       'descript',
       'accept'
    ];

    
}
