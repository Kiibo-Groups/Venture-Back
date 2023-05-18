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

use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;



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
}
