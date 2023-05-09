<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OpenpayController;
use App\Http\Controllers\NodejsServer;
use App\Http\Controllers\WhatsAppCloud;

use Illuminate\Http\Request;
use Auth; 
use App\Models\Admin;
use App\Models\AppUser;
use App\Models\Banner;
use App\Models\Events;
use App\Models\Surveys; 
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

	public function homepage_init($city_id)
	{
		$banner = new Banner;
		$events = new Events;
		$data = [
			'admin'		=> Admin::find(1),
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
			$user = new AppUser; 
			return response()->json([
				'data' => AppUser::find($id)
			]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
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


}
