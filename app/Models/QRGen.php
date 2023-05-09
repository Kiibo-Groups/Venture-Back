<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRGen extends Model
{
    use HasFactory;
    protected $table = 'qr_generator'; 

    protected $fillable =[
        'descript', // Descripcion del elemento
        'counter', // Cantidad de elementos a gennerar por usuario
        'date_limit', // Fecha limite para su intercambio
        'status', // activo/inactivo
    ];

    public function list()
    {
        return $this->hasMany('App\Models\ListQR')->orderBy('created_at');
    }
}
