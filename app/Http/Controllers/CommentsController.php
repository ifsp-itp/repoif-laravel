<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CommentsController extends Controller
{

    public static function store(Request $id , int $projeto){
        $actDate = date('Y-m-d');

        $comentc = new Comment();
        $comentc->project_id = $projeto;
        $comentc->data = Date::now();
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
