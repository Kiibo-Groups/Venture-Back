<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrReader extends Model
{
    use HasFactory;
    protected $table = 'qr_reader'; 

    protected $fillable =[
        'user_id',
        'qr_ir'
    ];

}
