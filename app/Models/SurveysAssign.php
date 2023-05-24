<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DOMDocument;
class SurveysAssign extends Model
{
    use HasFactory;
    protected $table = 'surveys_assign'; 

    protected $fillable =[
       'user_id',
       'surveys_id',
    ];

}
