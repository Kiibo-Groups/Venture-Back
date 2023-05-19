<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListQR; 
use App\Models\QRGen; 
use App\Models\QrReader;

use DB;
use Auth;
use Validator;
use Redirect;

class ReadQRController extends Controller
{
    
    public $folder = "admin.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QRGen::Orderby('id','DESC')->get();  
 
        return view($this->folder.'readingsqr.index', [ 
            'data' => $data,
            'link' 	=> '/qr_generator/'
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function reader(Request $request)
    {

        return response()->json($request->all());

    }

    public function validateqr(Request $request)
    {
        try {
            $code = $request->all()[0];
            $valid = ListQR::where('decript',$code)->first();

            if ($valid) {

                $valid->status = 1;
                $valid->save();

                $reader = new QrReader;
                $reader->user_id = $valid->user_id;
                $reader->qr_id   = $valid->id;
                $reader->save();

                return response()->json([
					'status' => 200
				]);
            }else {
                return response()->json([
					'status' => 'error',
					'data' => 'Codigo no encontrado'
				]);
            }

        } catch (\Exception $th) {
			return response()->json(['status' => 'error', 'error' => $th->getMessage()]);
		}
    }
}
