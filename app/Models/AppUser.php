<?php

namespace App\Models;

use App\Http\Controllers\Api\ApiController;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;
use Mail;
use DB;

class AppUser extends Authenticatable
{
    protected $table = 'app_user';

    protected $fillable =[
        'pic_profile',
        'status',
        'name',
        'email',
        'last_name',
        'birthday',
        'sex_type',
        'password',
        'pswfacebook',
        'phone',
        'otp',
        'refered',
        'saldo',
        'monedero'
    ];

    public function userTo()
    {
        return $this->hasMany('App\Models\ValueConn')->orderBy('created_at');
    }

    public function userFrom()
    {
        return $this->hasMany('App\Models\ValueConn')->orderBy('created_at');
    }

    public function addNew($data)
    {
        $count = AppUser::where('email', $data['email'])->count();

        if ($count == 0) {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

                $count_email = AppUser::where('email', $data['email'])->count();

                if ($count_email == 0) {
                    $add                = new AppUser;
                    $add->name          = ucwords($data['name']);
                    $add->email         = $data['email'];
                    $add->phone         = isset($data['phone']) ? $data['phone'] : 'null';
                    $add->password      = $data['password'];
                    $add->pswfacebook   = isset($data['pswfb']) ? $data['pswfb'] : 0;
                    $add->refered       = isset($data['refered']) ? $data['refered'] : '';

                    $add->last_name     = isset($data['last_name']) ? ucwords($data['last_name']) : 'null';
                    $add->birthday      = isset($data['birthday']) ? $data['birthday'] : 'null';
                    $add->sex_type      = isset($data['sex_type']) ? $data['sex_type'] : 'null'; 
                    $add->rol           = isset($data['rol']) ? $data['rol'] : 0;
                    $add->save();

                    return ['msg' => 'done', 'user_id' => $add->id];
                } else {
                    return ['msg' => 'Opps! Este User Name  ya existe.'];
                }
            } else {
                return ['msg' => 'Opps! El Formato del Email es invalido'];
            }
        } else {
            return ['msg' => 'Opps! Este correo electrónico ya existe.'];
        }
    }
 
    public function chkUser($data)
    {

        if (isset($data['user_id']) && $data['user_id'] != 'null') {
            // Intentamos con el id
            $res = AppUser::find($data['user_id']);

            if (isset($res->id)) {
                return ['msg' => 'user_exist', 'id' => $res->id, 'data' => $res,'role' => 'user'];
            } else {
                return ['msg' => 'not_exist'];
            }
        }
    }

    public function SignPhone($data)
    {
        $res = AppUser::where('id', $data['user_id'])->first();

        if ($res->id) {
            $res->phone = $data['phone'];
            $res->save();

            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! Algo salió mal.'];
        }

        return $return;
    }

    public function login($data)
    {
        $chk = AppUser::where('email', $data['email'])->first();

        $msg = "Detalles de acceso incorrectos";
        $user = 0;
        if (isset($chk->id)) // Validamos si existe el email
        {
            if ($chk->password == $data['password']) { // Validamos la contraseña
                $msg = 'done';
                $user = $chk->id;
            }
        }


        return ['msg' => $msg, 'user_id' => $user];
    }

    public function Newlogin($data)
    {
        $chk = AppUser::where('phone', $data['phone'])->first();

        if (isset($chk->id)) {
            return ['msg' => 'done', 'user_id' => $chk->id];
        } else {
            return ['msg' => 'error', 'error' => 'not_exist'];
        }
    }

    public function loginfb($data)
    {
        $chk = AppUser::where('email', $data['email'])->first();

        if (isset($chk->id)) {
            if ($chk->password == $data['password']) {
                // Esta logeado con facebook
                return ['msg' => 'done', 'user_id' => $chk->id];
            } else {
                // Esta logeado normal pero si existe se registra el FB - ID
                $chk->pswfacebook = $data['password'];
                $chk->save();
                // Registramos
                return ['msg' => 'done', 'user_id' => $chk->id];
            }
        } else {
            return ['msg' => 'Opps! Detalles de acceso incorrectos'];
        }
    }
 
    public function updateInfo($data, $id)
    {
        $count = AppUser::where('id', '!=', $id)->where('email', $data['email'])->count();

        if ($count == 0) {
            $add                = AppUser::find($id);
            $add->name          = $data['name'];
            $add->last_name     = $data['last_name'];
            $add->email         = $data['email']; 

            $add->birthday      = $data['birthday'];
            $add->sex_type      = $data['sex_type']; 
            $add->rol           = $data['rol']; 

            if (isset($data['password'])) {
                $add->password    = $data['password'];
            }

            if (isset($data['pic_profile'])) {
                // Si la imagen anterior es diferente a la defalult la eliminamos
                if ($add->pic_profile != 'not_available.png') {
                    @unlink("upload/users/".$add->pic_profile);
                   
                }

                if ($data['pic_profile'] == 'https://venture.xedik.com/upload/users/not_available.png') {
                    $add->pic_profile    = 'not_available.png';
                }else {
                    $add->pic_profile    = $data['pic_profile'];
                }

                
            }

            $add->save();

            return ['msg' => 'done', 'user_id' => $add->id, 'data' => $add];
        } else {
            return ['msg' => 'Opps! Este correo electrónico ya existe.'];
        }
    }

    public function forgot($data)
    {
        $res = AppUser::where('email', $data['email'])->first();

        if (isset($res->id)) {
            $otp = rand(1111, 9999);

            $res->otp = $otp;
            $res->save();

            $para       =   $data['email'];
            $asunto     =   'Codigo de acceso - A100TO';
            $mensaje    =   "Hola " . $res->name . " Un gusto saludarte, se ha pedido un codigo de recuperacion para acceder a tu cuenta en A100TO";
            $mensaje    .=  ' ' . '<br>';
            $mensaje    .=  "Tu codigo es: <br />";
            $mensaje    .=  '# ' . $otp;
            $mensaje    .=  "<br /><hr />Recuerda, si no lo has solicitado tu has caso omiso a este mensaje y te recomendamos hacer un cambio en tu contrasena.";
            $mensaje    .=  "<br/ ><br /><br /> Te saluda el equipo de A100TO";

            $cabeceras = 'From: A100TO' . "\r\n";

            $cabeceras .= 'MIME-Version: 1.0' . "\r\n";

            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            mail($para, $asunto, utf8_encode($mensaje), $cabeceras);

            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! Este correo electrónico no está registrado con nosotros.'];
        }

        return $return;
    }

    public function verify($data)
    {
        $res = AppUser::where('id', $data['user_id'])->where('otp', $data['otp'])->first();

        if (isset($res->id)) {
            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! OTP no coincide.'];
        }

        return $return;
    }

    public function updatePassword($data)
    {
        $res = AppUser::where('id', $data['user_id'])->first();

        if (isset($res->id)) {
            $res->password = $data['password'];
            $res->save();

            $return = ['msg' => 'done', 'user_id' => $res->id];
        } else {
            $return = ['msg' => 'error', 'error' => '¡Lo siento! Algo salió mal.'];
        }

        return $return;
    }
 

    /*
    |--------------------------------------
    |Get all data from db
    |--------------------------------------
    */
    public function getAll($store = 0)
    {
        return AppUser::get();
    }

    /*
    |--------------------------------------
    |Get all possible value connections
    |--------------------------------------
    */
    public function getConnections($user_id)
    {
        $exceptVC = ValueConn::where('app_user_id', $user_id)->get();
        $data   = [];
        $exceptData = ['password','pswfacebook','created_at','updated_at','otp','refered'];
        $excVC = [];

        foreach ($exceptVC as $exc => $val) {
            $excVC[] = $val->user_to;
        }

        // Buscamos conexiones de valor omitiendo las que ya tenemos y nuestros propio ID
        $users  = AppUser::whereNotIn('id',[$user_id])->whereNotIn('id',$excVC)->orderBy('id','DESC')->get();
        
        foreach ($users as $key => $value) {

            $img_exp = $value->pic_profile;
            $dat     = collect($value)->except($exceptData)->except('pic_profile');
            $pic_profile = asset('upload/users/'.$img_exp);
            $newData = $dat->put( 'pic_profile' , $pic_profile );

            $data[] = $newData;
        }

        return  $data;
    }

    /*
    |--------------------------------------
    |Get all Value Connections 
    |--------------------------------------
    */
    public function getConnectionsByUserId($user_id)
    {
        $req = ValueConn::where('app_user_id', $user_id)->get();
        $data = [];
        $root = new ApiController;

        foreach ($req as $key => $value) {
            // Obtenemos Informacion de usuarios 
            $endUser  = $root->getUser($value->user_to);

            /****** Ratings ********/
                $totalRate    = ValueConn::where('user_to',$value->user_to)->count();
                $totalRateSum = ValueConn::where('user_to',$value->user_to)->sum('rate');
                
                if($totalRate > 0)
                {
                    $avg          = $totalRateSum / $totalRate;
                }
                else
                {
                    $avg           = 0 ;
                }
            /****** Ratings ********/

            // Creamos array
            $data[] = [ 
                'user' => $endUser->original['data'],
                'rating' => $avg,
                'table_id'	=> $value->id,
                'created_at' => $value->created_at->diffForHumans(),
            ];
        }


        return $data;
    }

    public function getAllConnections()
    {
        $req = ValueConn::get();
        $data = [];
        $root = new ApiController;

        foreach ($req as $key => $value) {
            // Obtenemos Informacion de usuarios Inicial
            $FromUser  = $root->getUser($value->user_from);
            // Obtenemos Informacion de usuarios final
            $endUser  = $root->getUser($value->user_to);

            /****** Ratings ********/
                $totalRate    = ValueConn::where('user_to',$value->user_to)->count();
                $totalRateSum = ValueConn::where('user_to',$value->user_to)->sum('rate');
                
                if($totalRate > 0)
                {
                    $avg          = $totalRateSum / $totalRate;
                }
                else
                {
                    $avg           = 0 ;
                }
            /****** Ratings ********/

            // Creamos array
            $data[] = [ 
                'Fromuser' => $FromUser->original['data'],
                'Enduser' => $endUser->original['data'],
                'rating' => $avg,
                'table_id'	=> $value->id,
                'created_at' => $value->created_at->diffForHumans(),
            ];
        }


        return $data;
    }

    /*
    |--------------------------------------
    |Search all Value Connections 
    |--------------------------------------
    */
    public function searchByUserName($val)
    {
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
        
        $exceptVC = ValueConn::where('app_user_id', $user_id)->get();
        $excVC = [];
    
        foreach ($exceptVC as $exc) {
            $excVC[] = $exc->user_to;
        }
      
        $req = AppUser::where(function($query) use($val, $user_id, $excVC) {
            // Que el status del producto este acitov
            $query->where('status',0);
            // Que sea diferente al usuario
            $query->whereNotIn('id',[$user_id]);
            // Omitimos los que ya esten conectados
            $query->whereNotIn('id',$excVC);
            // Busqueda por LIKE
            if(isset($val))
            {
                $q   = strtolower($val);
                $query->whereRaw('Lower(name) like "%' . $q . '%"');
            }
        })->withCount('userTo')->get();
        
        $data = [];
        $root = new ApiController;

        foreach ($req as $key) {
            
            /****** Ratings ********/
                $totalRate    = ValueConn::where('user_to',$key->id)->count();
                $totalRateSum = ValueConn::where('user_to',$key->id)->sum('rate');
                
                if($totalRate > 0)
                {
                    $avg          = $totalRateSum / $totalRate;
                }
                else
                {
                    $avg           = 0 ;
                }
            /****** Ratings ********/

            // Creamos array
            $data[] = [ 
                'id'    => $key->id,
                'name'  => $key->name,
                'last_name' => $key->last_name,
                'email' => $key->email,
                'birthday'  => $key->birthday,
                'pic_profile' => asset('/upload/users/'.$key->pic_profile),
                'count' => $key->user_to_count,
                'rating' => $avg,
            ];
        }


        return $data;
    }
}
