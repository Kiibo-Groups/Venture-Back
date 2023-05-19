<?php

namespace App\Http\Controllers\Api;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BackServer; 

use Illuminate\Http\Request;
use Auth; 
use App\Models\Admin;
use App\Models\AppUser;
use App\Models\Banner;
use App\Models\Events;
use App\Models\Surveys; 
use App\Models\ValueConn;
use App\Models\QrReader;
use App\Models\QRGen;
use App\Models\ListQR;

use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;

use QrCode;
use Uuid;

class ApiController extends Controller
{

	public function welcome()
	{
		$res = new Slider;

		return response()->json(['data' => $res->getAppData()]);
	}

	public function getDataInit()
	{
		
		try {
			$data = [
				'admin'		=> Admin::find(1)
			];
	
			return response()->json(['data' => $data]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function homepage_init($user_id)
	{
		$banner = new Banner;
		$events = new Events;
		$connects = new AppUser;

		$data = [
			'value_conn'	=> $connects->getConnections($user_id),
			'admin'			=> Admin::find(1),
			'banners_top'   => $banner->getAppDataTop(),
			'banners_mid'   => $banner->getAppDataMiddle(),
			'events'   		=> $events->getAppData()
		];

		return response()->json(['data' => $data]);
	}

	/**
     * Funciones de inicio de sesion y validacion de usuario
     */

	public function login(Request $Request)
	{
		try {
			$res = new AppUser;
			return response()->json($res->login($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function chkUser(Request $Request)
	{
		try {
			$res = new AppUser;
			return response()->json($res->chkUser($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function Newlogin(Request $Request)
	{
		try {
			$res = new AppUser;
			return response()->json($res->Newlogin($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function userinfo($id)
	{
		try { 
			$data	= AppUser::find($id);
			$connVF = ValueConn::where('app_user_id', $id)->count();
			$connvT = ValueConn::where('user_to', $id)->count();
			$exceptData = ['pswfacebook','created_at','updated_at','otp','refered'];
			// Cambiamos los datos de la imagen			
			$img_exp = $data->pic_profile;
            $dat     = collect($data)->except($exceptData)->except('pic_profile');
            $pic_profile = asset('upload/users/'.$img_exp);
            // Agregamos los nuevos datos
			$dat->put( 'pic_profile' , $pic_profile );
			$dat->put( 'connVF' , $connVF );
			$dat->put( 'connvT' , $connvT );
			
			return response()->json([
				'data' => $dat, 
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}
	
	public function updateInfo($id,Request $Request)
	{
		$res = new AppUser;
		return response()->json($res->updateInfo($Request->all(),$id));
	}

	/**
     * Funciones de registro
     */
	public function signup(Request $Request)
	{
		try {
			$res = new AppUser;
			return response()->json($res->addNew($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['msg' => 'error', 'error' => $th->getMessage()]);
		}
	} 

	public function sendOTP(Request $Request)
	{
		$phone = $Request->phone;
		$hash  = $Request->hash;

		return response()->json(['otp' => app('App\Http\Controllers\Controller')->sendSms($phone, $hash)]);
	}

	public function SignPhone(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->SignPhone($Request->all()));
	}

	/**
	 * Funciones para conexiones de valor
	 */
	public function getUser($user)
	{
		try {
			$data = AppUser::where('id',$user)->withCount('userTo')->first();
			$exceptData = ['password','pswfacebook','created_at','updated_at','otp','refered'];
        
			$img_exp = $data->pic_profile;
            $dat     = collect($data)->except($exceptData)->except('pic_profile');
            $pic_profile = asset('upload/users/'.$img_exp);
            $newData = $dat->put( 'pic_profile' , $pic_profile );

			return response()->json([
				'data' => $newData
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function createConn(Request $Request)
	{
		try {
			$input = $Request->all();
			$lim_data_createConn = new ValueConn;
			// Creamos la conexion en el primer servidor
			$req = $lim_data_createConn->create($input);

			if ($req) {
				// Creamos la conexion en tiempo real en el backServer
				$backServer = new BackServer;
				// Obtenemos Informacion de usuarios
				$initUser = $this->getUser($req->app_user_id);
				$endUser  = $this->getUser($req->user_to);
				// Creamos nuevo array
				$newData = [
					'userFrom' => $initUser->original['data'],
					'userTo' => $endUser->original['data'],
					'rating' => $req->rate,
					'table_id'	=> $req->id,
					'created_at' => $req->created_at
				];
				// Agregamos
				$addBack = $backServer->CreateConn($newData);
				// Actualizamos principal
				$lims_date_updateConn = ValueConn::find($req->id);
				$lims_date_updateConn->external_id = $addBack['data'];
				$lims_date_updateConn->save();
			}

			return response()->json([
				'data' => true
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function getConnections($id)
	{
		try {
			$req = new AppUser;
			return response()->json([
				'data' => $req->getConnectionsByUserId($id)
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function search($query)
	{
		try {
			$req = new AppUser;
			return response()->json([
				'data' => $req->searchByUserName($query)
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	/**
	 * Generacion y manejo de Codigos QR
	 */
	public function getCatsQR()
	{
		try {
			$req = new QRGen;
			return response()->json([
				'data' => $req->getAll()
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function getAllQR($id)
	{
		try {
			$list = ListQR::where('user_id',$id)->where('status',0)->get();
			$data = [];
			foreach ($list as $key) {
				
				$qrInfo = QRGen::find($key->qr_id);

				$data[] = [
					'info' => $qrInfo->descript,
					'decript' => $key->decript,
					'date_limit' => $qrInfo->date_limit,
					'date_create' => $key->created_at->diffForHumans(),
					'status' => $key->status,
					'qr' => $key->qr_data
				];
			}
			return response()->json([
				'status' => 200,
				'data' => $data
			]);
		} catch (\Throwable $th) {
			return response()->json(['status' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function getQRCode($el, $id)
	{
		
		try {
			$listQR = ListQR::where('user_id',$id)->where('qr_id',$el)->count();
			$options = QRGen::find($el);
			$tot     = $options->counter;
			
			if ($listQR >= $tot) { // ya se ha generado un codigo QR para este usuario y para este QR
				return response()->json([
					'status' => 'duplicate', 
					'error' => "Este QR ya ha sido usado anteriormente."
				]);
			}else {
				// Generamos los elementos
				
				$codeQR  = [];

				for ($i=0; $i < $tot; $i++) { 
					// Generamos Codigo Unico identificador
					$pattern = substr(time(),0,3).substr(Uuid::generate()->string,0,8);
					$key = '0'.$id.'x'.$i.substr(md5($pattern),0,6);
					// Generamos el QR
					$qr_data   = base64_encode(QrCode::format('png')
								->size(200)
								->generate(strtoupper($key)));
					// Guardamos en la tabla
					$lims_data_listqr = new ListQR;
					$lims_data_listqr->qr_id = $el;
					$lims_data_listqr->qr_data = $qr_data;
					$lims_data_listqr->decript = strtoupper($key);
					$lims_data_listqr->user_id = $id;
					$lims_data_listqr->status  = 0;
					
					$lims_data_listqr->save();
					// Guardamos en el array para mostrar al cliente
					$codeQR[] = $qr_data;
				}


				return response()->json([
					'status' => 200,
					'data' => $codeQR
				]);
			}

		
		} catch (\Exception $th) {
			return response()->json(['status' => 'error', 'error' => $th->getMessage()]);
		}
	}
}
