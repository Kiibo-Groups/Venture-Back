<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Beacons;  
use App\Models\Admin;

use DB;
use Validator;
use Redirect;
use IMS;

class BeaconsController extends Controller
{
    public $folder  = "admin/beacons.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View($this->folder.'index',[
			'data' => Beacons::get(),
			'link' => '/beacons/'
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View($this->folder.'add',[
			'data' => new Beacons,
			'form_url' 	=> '/beacons'
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
        try {
            $input = $request->all();
            $lims_data_beacons = new Beacons;
            $lims_data_beacons->create($input);
            return redirect('/beacons')->with('message','Elemento agregado con éxito.');
        } catch (\Exception $th) {
            return redirect('/beacons')->with('error','Error: '.$th->getMessage());
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
        return View($this->folder.'add',[
			'data' => Beacons::find($id),
			'form_url' 	=> '/beacons'
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
        return View($this->folder.'edit',[
			'data' => Beacons::find($id),
			'form_url' 	=> '/beacons/'.$id
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
        try {
            $input = $request->all();
            $lims_data_beacons = Beacons::find($id);
            $lims_data_beacons->update($input);
            return redirect('/beacons')->with('message','Elemento actualizado con éxito.');
        } catch (\Exception $th) {
            return redirect('/beacons')->with('error','Error: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Beacons::find($id); 
		$res->delete();
		return redirect('/beacons')->with('message','Registro eliminado con éxito.');
    }

    /*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= Beacons::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect('/beacons')->with('message','Estado actualizado con éxito.');
	}
}
