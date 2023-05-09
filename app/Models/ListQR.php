<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListQR extends Model
{
    use HasFactory;
    protected $table = 'list_qr'; 

    protected $fillable =[
        'q_r_gen_id', // Tipo de QR generado enlazado a tabla QRGen
        'qr_data', // Info del QR
        'user_id', // Id del usuario vinculado
        'status', // activo/inactivo
    ];

    
}
