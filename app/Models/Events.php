<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events'; 

    protected $fillable =[
        'portada',
        'titulo',
        'descript',
        'fecha',
        'register',
        'calendar',
        'location',
        'room',
        'status'
    ];

    public function getAppData()
    {
        $data = [];
        $req  = Events::where('status',0)->get();

        foreach($req as $row)
        {
            $data[] = [
                'id'        => $row->id,
                'portada'   => Asset('upload/events/'.$row->portada),
                'titulo'    => ucfirst($row->titulo),
                'descript'  => ucwords($row->descript),
                'fecha'     => $row->fecha,
                'register'  => $row->register,
                'calendar'  => $row->calendar,
                'location'  => $row->location,
                'room'      => $row->room    
            ];
        }

        return $data;
    }
}
