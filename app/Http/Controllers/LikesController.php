<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Project;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public static function  store(Project $id){

        $likeis = Likes::where('user_id',  auth()->user()->id)->first();
        $projectis = Likes::where('project_id',  $id->id)->first();

   





        if($likeis && $projectis){

            $likeDescurtir = Likes::where([
                                       'user_id' => auth()->user()->id,
                                       'project_id' => $id->id
                                      ])->first();
            $likeDescurtir->delete();
            $cont = Likes::all()->count();

            return redirect()->route('project.show', ['project' => $id->id]);

        }else{
             $projeto = Project::where('id', $id->id);
             $like = new Likes();
             $like->project_id = $id->id;
             $like->user_id = auth()->user()->id;
          
        

             $like->save();
             
             $cont = Likes::all()->count();
             
             return redirect()->route('project.show', ['project' => $id->id]);

        }


    }
}
