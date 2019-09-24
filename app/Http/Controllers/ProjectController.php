<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policies\ProjectPolicy;
use App\Project;
use App\User;

use Dawson\Youtube\Facades\Youtube;
use Exception;

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

        $projects = Project::all()->sortByDesc("likes");
        return view('project.list')->with('projects', $projects);
    }

    //PESQUISAR PROJETOS
    public function search(Request $request)
    {
        $projects = Project::search($request->search)->sortByDesc("likes");

        return view('project.list', [
            'projects' => $projects,
            'search' => $request->search
        ]);
    }

    //NOVOS
    public function newProjects()
    {
        $projects = Project::all()->sortByDesc("date");
        return view('project.list')->with('projects', $projects);
    }

    //POR TIPO

    //FOTOS
    public function photosProjects()
    {
        $projects = Project::where(
            'type', 1)->get();
        return view('project.list')->with('projects', $projects);
    }

    //VIDEOS
    public function videosProjects()
    {
        $projects = Project::where(
            'type', 2)->get();
        return view('project.list')->with('projects', $projects);
    }

    //PDF
    public function pdfProjects()
    {
        $projects = Project::where(
            'type', 3)->get();
        return view('project.list')->with('projects', $projects);
    }

    //SCRIPTS
    public function codesProjects()
    {
        $projects = Project::where(
            'type', 4)->get();
        return view('project.list')->with('projects', $projects);
    }



    //USUARIOS
    public function userProject($id)
    {
        $projects = Project::where(
            'user_id', $id)->get();
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

        $thumbnailURL = null;

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

            try{

                $video = Youtube::upload($request->file('file'), [
                    'title'       => request('title'),
                    'description' => request('description'),
                    'tags'        => request('tags'),
                    'category_id' => request('type')
                ]);

                $snippet = $video->getSnippet();
                $thumbnailURL = $snippet->thumbnails->high->url;

                } catch(Exception $e) {
                    dd($e->getMessage());
                }
                    
        } 
                       

        $project = Project::create([

            'user_id' => auth()->id(),
            'title' => request('title'),
            'description' => request('description'),
            'type' => request('type'),
            'download' => $download,
            'date' => $actDate,
            'project' => $nameFile,
            'likes' => 0,
            'thumbnailURL' => $thumbnailURL
            
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
