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

        $auth = auth()->user();
        $user = $request->all();

        $user['image'] = $auth->image;
        if($request->hasFile('imageProfile') && $request->file('imageProfile')->isValid())
        {   

            if($auth->image)
                 $name = pathinfo($auth->image)['filename'];
            else
                $name = $auth->id.kebab_case($auth->name);

            $extenstion = $request->imageProfile->extension();

            $nameFile = "{$name}.{$extenstion}";
            $user['image'] = $nameFile;

            $upload = $request->imageProfile->storeAs('users', $nameFile);

            if ( !$upload )
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload da imagem')
                        ->withInput();

        }

        User::find($id)->update($user);

        return redirect('projects');
        
    }

}