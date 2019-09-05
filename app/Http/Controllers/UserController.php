<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class userController extends Controller
{

	public function index() //listar todos
    {

        $users = User::all();
        //
    }

    public function profile(User $id) //mostrar o Usuário
    {
        return view('user.profile')->with('user', $id);
    }

}