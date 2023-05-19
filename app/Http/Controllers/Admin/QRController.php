<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListQR; 
use App\Models\QRGen; 

use DB;
use Auth;
use Validator;
use Redirect;
class QRController extends Controller
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
 
        return view($this->folder.'qr.index', [ 
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
        return view($this->folder.'qr.add', [ 
            'data' => new QRGen
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $input = $request->all();
            $lims_qr_data = new QRGen;
         
            $lims_qr_data->create($input);        
            return redirect('/qr_generator')->with('message', 'QR agregado con éxito ...');
       } catch (\Exception $th) {
        return Redirect::to('/qr_generator/add')->with('error', 'Ha ocurrido un problema al intentar crear el elemento, '.$th->getMessage());
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View($this->folder.'qr.add',[
			'data' 		=> new QRGen,
			'form_url' 	=> '/qr_generator'
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return View($this->folder.'qr.edit',[
			'data' 		=> QRGen::find($id),
			'form_url' 	=> '/qr_generator/'.$id
		]);
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
        $input = $request->all();
        $lims_qr_data = QRGen::find($id);
        
        $lims_qr_data->update($input); 
		return redirect('/qr_generator')->with('message','Registro actualizado con éxito.');
    }

    /*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function destroy ($id)
	{
		$res = QRGen::find($id); 
		$res->delete();
		return redirect('/qr_generator')->with('message','Registro eliminado con éxito.');
	}

	/*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= QRGen::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect('/qr_generator')->with('message','Estado actualizado con éxito.');
	}
}
