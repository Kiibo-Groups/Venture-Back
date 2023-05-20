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

   

    public function getAll()
    {
        return QRGen::where('status',1)->get();   
    }

    public function GetQRAdmin(){
      $list = QRGen::where('status',1)->get();
        
      $data = [];

      foreach ($list as $key) {
        $generados = ListQR::where('qr_id',$key->id)->count();

        $data[] = [
            'id' => $key->id,
            'descript' => $key->descript,
            'counter' => $key->counter,
            'date_limit' => $key->date_limit,
            'status' => $key->status,
            'generados' => $generados
        ];
      }

      return $data;
    }

    public function GetListQRAdmin()
    {
        $generados = ListQR::select('qr_id')->distinct('qr_id')->get();
        $data = [];

        foreach ($generados as $key => $value) {


            $listQR = ListQR::where('qr_id',$value->qr_id)->first();
             
            $QRInfo = QRGen::find($listQR->qr_id);
            $counter = ListQR::where('qr_id',$listQR->qr_id)->count();
            $userInfo = AppUser::find($listQR->user_id);

            $data[] = [
                'id' => $listQR->id,
                'QR' => $listQR->qr_data,
                'descript' => $QRInfo->descript,
                'counter' => $counter,
                'user' => $userInfo->name.' '.$userInfo->last_name,
                'email' => $userInfo->email,
                'status' => $listQR->status,
            ];
        }

        return $data;
    }
}
