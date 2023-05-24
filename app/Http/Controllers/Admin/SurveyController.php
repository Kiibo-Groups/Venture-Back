<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surveys; 
use App\Models\Beacons;
use App\Models\BeaconsSign;
use App\Models\SurveysAssign;

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
			'data' => Surveys::withCount('getSigners')->orderBy('id','DESC')->get(),
            'beacons' => Beacons::withCount('getSigners')->get(),
			'link' => '/survey/',
            'form_url' => '/survey/assignUsers/'
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

    public function assignUsers(Request $Request)
    {
        // return response()->json($Request->all());
        try {
            $push = new Controller;
            $beacon_id = $Request->get('beacon');
            $survey_id = $Request->get('survey_id');

            // Limpiamos
            SurveysAssign::where('surveys_id',$survey_id)->delete();
            // Registramos de nuevo
            $gtUs = BeaconsSign::where('beacons_id',$beacon_id)->get();
            foreach ($gtUs as $btc) {
            // Creamos
            $svAss = new SurveysAssign;
            $svAss->create([
                'user_id' => $btc->user_id,
                'surveys_id' => $survey_id
            ]);

            // Notificamos
            $push->sendPush("Encuesta de Venture Café",
                "Hola, Ayudanos con una pequeña encuesta entrando en la aplicación de Venture Café. Recuerda esperar al menos 2 minutos para que la encuesta inicie.",
                $btc->user_id);
            }

            return redirect('/survey')->with('message','Encuesta lanza con éxito.');
        } catch (\Exception $th) {
            return redirect('/survey')->with('error','Error: '.$th->getMessage());
        }
    }
}
