<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Events;  
use App\Models\Admin;

use DB;
use Validator;
use Redirect;
use IMS;

class EventsController extends Controller
{
    public $folder  = "admin/events.";
	/*
	|---------------------------------------
	|@Showing all records
	|---------------------------------------
	*/
	public function index()
	{			
		return View($this->folder.'index',[
			'data' => Events::get(),
			'link' => '/events/'
		]);
	}	
	
	/*
	|---------------------------------------
	|@Add new page
	|---------------------------------------
	*/
	public function show()
	{	
		return View($this->folder.'add',[
			'data' 		=> new Events,
			'form_url' 	=> '/events'
		]);
	}
	
	/*
	|---------------------------------------
	|@Save data in DB
	|---------------------------------------
	*/
	public function store(Request $Request)
	{			
		try {
            $input = $Request->all();	
            $lims_data_events = new Events;
            
            if(isset($input['portada']))
            {
                $filename   = time().rand(111,699).'.' .$input['portada']->getClientOriginalExtension(); 
                $input['portada']->move("upload/events/", $filename);   
                $input['portada'] = $filename;   
            }

            // Creamos
            $lims_data_events->create($input);
            
            return redirect('/events')->with('message','Elemento agregado con éxito.');
        } catch (\Exception $th) {
            return redirect('/events')->with('error','Error: '.$th->getMessage());
        }
	}
	
	/*
	|---------------------------------------
	|@Edit Page 
	|---------------------------------------
	*/
	public function edit($id)
	{				
		return View($this->folder.'edit',[
			'data' 		=> Events::find($id),
			'form_url' 	=> '/events/'.$id
		]);
	}
	
	/*
	|---------------------------------------
	|@update data in DB
	|---------------------------------------
	*/
	public function update(Request $Request,$id)
	{	
		try {
            $input = $Request->all();	
            $lims_data_events = Events::find($id);
            
            if(isset($input['portada']))
            {
                // Eliminamos imagen anterior
                unlink("upload/events/".$lims_data_events->portada);

                $filename   = time().rand(111,699).'.' .$input['portada']->getClientOriginalExtension(); 
                $input['portada']->move("upload/events/", $filename);   
                $input['portada'] = $filename;   
            }

            // Creamos
            $lims_data_events->update($input);
            
            return redirect('/events')->with('message','Elemento actualizado con éxito.');
        } catch (\Exception $th) {
            return redirect('/events')->with('error','Error: '.$th->getMessage());
        }
	}
	
	/*
	|---------------------------------------------
	|@Delete Data
	|---------------------------------------------
	*/
	public function delete($id)
	{
		$res = Events::find($id);
		@unlink("upload/events/".$res->img);
		$res->delete();
		return redirect('/events')->with('message','Registro eliminado con éxito.');
	}

	/*
	|---------------------------------------------
	|@Change Status
	|---------------------------------------------
	*/
	public function status($id)
	{
		$res 			= Events::find($id);
		$res->status 	= $res->status == 0 ? 1 : 0;
		$res->save();

		return redirect('/events')->with('message','Estado actualizado con éxito.');
	}
}
