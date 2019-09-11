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


    public function edit(User $id) //mostrar o formulario preenchido com os dados
    {
        $user = User::find($id);
        return view('user.edit')->with('user', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //salvar o formulario apos edicao
    {
        $user = $request->all();
        User::find($id)->update($user);

        return redirect('projects');
        
    }

}