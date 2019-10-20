<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Project;

class userController extends Controller
{

	public function index() //listar todos
    {

        $users = User::all();
        //
    }

    public function profile(User $id) //mostrar o Usuário
    {
        $user = $id;
        $likes = 0;
        $comments =0;
        $projects = Project::where(
            'user_id', $user->id)->get();

        $created = Project::where(
            'user_id', $user->id)->count();

        foreach ($projects as $project)
        {
            $likes += $project->likes->count();
            $comments += $project->comments->count();
            
        }
        

        return view('user.profile')->with('user', $id)
                                    ->with('projects', $projects)
                                    ->with('created', $created)
                                    ->with('likes', $likes)
                                    ->with('comments', $comments);
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
        $user['password'] = Hash::make($request->password);
        $user['email'] = $auth->email;

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