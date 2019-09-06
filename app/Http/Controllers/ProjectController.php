<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policies\ProjectPolicy;
use App\Project;
use App\User;

use Dawson\Youtube\Facades\Youtube;

/*

criar controlador com as acoes padrao
php artisan make:controller --resource NOMEDOCONTROLADORController

Criar modelo junto com a migration
php artisan make:model Project -m

*/
class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //listar todos
    {

        $projects = Project::all();
        return view('project.list')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //form de criacao de novo projeto
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //salvar o projeto
    {
        $actDate = date('Y/m/d');
        $nameFile = null;

        $tipo = request('type');

        



        

        if ($request->hasFile('file') && $request->file('file')->isValid()) {

        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));
 
        // Recupera a extensão do arquivo
        $extension = $request->file->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";
 
        // Faz o upload:
        $upload = $request->file->storeAs('files', $nameFile);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/files/nomedinamicoarquivo.extensao
 
        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload )
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
        $download = $nameFile;


                        
        if($tipo == '2') {

            $video = Youtube::upload($request->file('file'), [
            'title'       => 'Teste',
            'description' => 'You can also specify your video description here.',
            'tags'        => ['foo', 'bar', 'baz'],
            'category_id' => 10
        ]);

        $nameFile = $video->getVideoId();
        //$caminhoDaImagem = $video->getThumbnailUrl();

        //dd($caminhoDaImagem);




        } 

        else if ($tipo == '3') {
            $nameFile = 'pdf.png';
        } 

        else if ($tipo =='4') {
            $nameFile = 'script.png';
        }
                       

        $project = Project::create([

            'user_id' => auth()->id(),
            'title' => request('title'),
            'description' => request('description'),
            'type' => request('type'),
            'download' => $download,
            'date' => $actDate,
            'project' => $nameFile,
            'likes' => 0

    ])->save();                

              
}

    return redirect('projects'); 
    
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $id) //mostrar o projeto
    {
        return view('project.show')->with('project', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $id) //mostrar o formulario preenchido com os dados
    {
        $project = Project::find($id);
        return view('project.edit')->with('project', $id);
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
        $project = $request->all();
        Project::find($id)->update($project);

        return redirect('projects');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //deletar o projeto
    {

        Project::find($id)->delete();
        return redirect('projects');

    }

    public function darLike($id) {
        $project = Project::find($id);
        $project->likes += 1;
        $project->save(); 

        return back()->withInput();
    }
}
