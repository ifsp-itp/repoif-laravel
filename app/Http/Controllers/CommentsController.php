<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Project;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public static function store(Request $id , int $projeto){
         
           $comentc = new Comment();
           $comentc->project_id = $projeto;
           $comentc->data = date('Y-m-d');
           $comentc->body = $id->body;
           $comentc->user_id = auth()->user()->id;

           $comentc->save();
           
           $cont = Comment::all()->count();
           
           return redirect()->route('project.show', ['project' => $projeto]);

    }
    public static function destroy(Comment $id){
        $id->delete();

        return redirect()->back();
    }
}
