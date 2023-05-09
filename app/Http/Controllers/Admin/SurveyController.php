<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surveys; 

use DB;
use Auth;
use Validator;
use Redirect;

class SurveyController extends Controller
{
    public $folder = "admin/surveys.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View($this->folder.'index',[
			'data' => Surveys::orderBy('id','DESC')->get(),
			'link' => '/survey/'
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $Request)
    {
        try {
            $input = $Request->all();	
            $lims_data_Surveys = new Surveys;
         
            // Creamos
            $lims_data_Surveys->create($input);
            
            return redirect('/survey')->with('message','Elemento agregado con éxito.');
        } catch (\Exception $th) {
            return redirect('/survey')->with('error','Error: '.$th->getMessage());
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
			'data' 		=> new Surveys,
			'form_url' 	=> '/survey'
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
			'data' 		=> Surveys::find($id),
			'form_url' 	=> '/survey/'.$id
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $Request, $id)
    {
       
		try {
            $input = $Request->all();	
            $lims_data_Surveys = Surveys::find($id);
             
            // Creamos
            $lims_data_Surveys->update($input);
            
            return redirect('/survey')->with('message','Elemento actualizado con éxito.');
        } catch (\Exception $th) {
            return redirect('/survey')->with('error','Error: '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $res = Surveys::find($id); 
		$res->delete();
		return redirect('/survey')->with('message','Registro eliminado con éxito.');
    }

    /*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= Surveys::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect('/survey')->with('message','Estado actualizado con éxito.');
	}
}
