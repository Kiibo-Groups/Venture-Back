<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DOMDocument;
class Surveys extends Model
{
    use HasFactory;
    protected $table = 'surveys'; 

    protected $fillable =[
       'script', 
       'status'
    ];

    public function getSigners()
    {
        return $this->hasMany('App\Models\SurveysAssign')->orderBy('created_at');
    }

    function getAppData()
    {
        $data = [];
        $req  = Surveys::where('status',0)->orderBy('id','DESC')->get();

        $grabbed_src = "";
        foreach($req as $row)
        { 
            $html = $row->script;
            $dom = new DOMDocument;
            $dom->loadHTML($html);
            $nodes = $dom->getElementsByTagName("script");
            foreach ($nodes as $node)
            {
                $attributes = $node->attributes;
                foreach ( $attributes as $attr )
                {
                    if ( $attr->name == "src" ) $grabbed_src = $attr->value;
                }
            }

            $data[] = [
                'id'        => $row->id,
                'script'    => $grabbed_src
            ];
        }

        return $data;
    }
    
}
