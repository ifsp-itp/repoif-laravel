<?php

namespace App\Http\Controllers;

use App\User;
use App\Likes;
use Exception;
use Validator;
use App\Comment;
use App\Project;
use App\UploadDaily;
use ZanySoft\Zip\Zip;
use App\Facades\Upload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Policies\ProjectPolicy;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\SplFileInfo;
use \Symfony\Component\HttpFoundation\File\UploadedFile as Video;


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
    public function index($teste = null) //listar todos
    {
        print_r($teste);

        $projects = Project::all();
        return view('project.list')->with('projects', $projects);
    }

    /**
     * function()
     * SEARCH PROJETOS
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $projects = Project::search($request->search);

        return view('project.list', [
            'projects' => $projects,
            'search' => $request->search
        ]);
    }

    /**
     * NOVOS PROJECTS
     *
     * @return void
     */
    public function newProjects()
    {
    
        $projects = Project::all()->sortByDesc("id");
        return view('project.list')->with('projects', $projects);
    }
   /**
    * Undocumented function
    * POR TIPO
    * FOTOS
    * @return void
    */
  
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

    //SCRIPTS
    public function codesProjects()
    {
        $projects = Project::where(
            'type', 3)->get();
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

    public function facade(){
        
    }
    /**
     * function file_storage_private
     * $path_file converted path
     */


     private function file_storage_private($path_file = ''){
        if($path_file != ''){
            return  new Video(storage_path().'\app\public\files'.'\\'."$path_file", "$path_file", 'video/mp4', 0, false);
        }else{
            return false;
        }
     }
     /**
      * documented function upload
      *
      *
      * @param [type] $file
      * @param array $values [titulo, tags, channel]
      * @return void
      */

    public function store(Request $request) //salvar o projeto
    {

        dd($request);


        $nameFile = null;
        $download = null;
        $thumbnailURL = null;
        $tipo = request('type');
        $actDate = date('Y-m-d');


        if($tipo == '2') {

                try {
                    //dailymotion
                    $upload = new UploadDaily();
                    $resul =   $upload->upload(request('title'), $request->file('file'));
                   
      
                    $enviado = 1;

                    $project = Project::create([
                      'user_id' => auth()->id(),
                      'title' => request('title'),
                      'description' => request('description'),
                      'type' => request('type'),
                      'download' => $resul['video']['id'],
                      'date' => $actDate,
                      'extension' => 'Video',
                      'project' => $resul['video']['id'],
                      'sent' => $enviado,
                      'views' => 0,
                      'thumbnailURL' => $thumbnailURL
              
                      ])->save();


                    //youtube
                    //$video = Youtube::upload($request->file('file'), [
                      //  'title'       => request('title'),
                       // 'description' => request('description'),
                        //'tags'        => ['foo', 'bar', 'baz'],
                      //  'category_id' => request('type')
                    //]);
               

                    //$snippet = $video->getSnippet();
                    //$thumbnailURL = $snippet->thumbnails->high->url;
                    //$enviado = 1;

                    //$nameFile = $video->getVideoId();

                    //$project = Project::create([
                    //'user_id' => auth()->id(),
                    //'title' => request('title'),
                    //'description' => request('description'),
                    //'type' => request('type'),
                    //'download' => $download,
                    //'date' => $actDate,
                    //'extension' => 'Video',
                    //'project' => $nameFile,
                    //'sent' => $enviado,
                    //'views' => 0,
                    //'thumbnailURL' => $thumbnailURL

                    //])->save();

                    return response()->json(['success' => 'sucesso no upload do video para o  dailymotion!!!']);



                    } catch(Exception $e) {
                   
                
                        $enviado = 0;

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
                        }

                        $project = Project::create([
                        'user_id' => auth()->id(),
                        'title' => request('title'),
                        'description' => request('description'),
                        'type' => request('type'),
                        'download' => $download,
                        'extension' => 'Video',
                        'date' => $actDate,
                        'project' => $nameFile,
                        'sent' => $enviado,
                        'views' => 0,
                        'thumbnailURL' => $thumbnailURL

                    ])->save();

                return response()->json(['success'  => 'o upload foi realizado mas não foi possivel para o dailymotion']);
            } 
 
            } else {
                
                try{
                if($tipo =="3"){//identifica se é um arquivo
                        
                        if($request->file->extension() == "zip"){//faz teste para saber se este arquivo é realmente um ZIP
                            if(Storage::makeDirectory("web")){//cria pasta chamada web para armazenar os uploads dos sites
                                if ($request->hasFile('file') && $request->file('file')->isValid()) {//testar se arqquivo é valido
                                   
                                    $name = uniqid(date('HisYmd'));//Define um aleatório para o arquivo baseado no timestamps atual
                             
                                    $extension = $request->file->extension();// Recupera a extensão do arquivo
                                  
                                    $nameFile = "{$name}.{$extension}"; // Define finalmente o nome

                                    $upload = $request->file->storeAs('files', $nameFile);// Faz o upload:

                                   //procura no zip se existe o arquivo index.html que é a pagina principal do site
								   $isindex = false;//inicia variavel $isindex com valor falso
                                   foreach(Zip::open('storage/files/'.$nameFile)->listFiles() as $item){
                                            if("index.html" == $item){
                                                
                                                $isindex = true;
                                                break;
                                                //caso ele achar ele armazena valor verdadeiro dentro da variavel  $isindex caso não achar ela continua como falso   
                                            }
                                   }
                             
                                   
                    if($isindex == true){  //se a variavel $isindex for igual a true ou seja se o arquivo index existir
                            if(Zip::open('storage/files/'.$nameFile)->extract("storage/web/$name")){  //extrai o arquivo zip e adiciona a pasta web e verifica se foi extraido com sucesso
                                    $path = "/storage/web/$name"; //salva caminho do site dentro da variavel $path 
                            }
                                  
                        //o arquivo foi armazenado em storage/app/public/files/nome-dinamico-do-arquivo.extensao
                        //E o site dentro de storage/app/public/web/nome-dinamico-da-pasta/arquivos-do-site
                             
                                    // Verifica se NÃO deu certo o upload (Redireciona de volta)
                                    if ( !$upload )
                                        return redirect()
                                                    ->back()
                                                    ->with('error', 'Falha ao fazer upload')
                                                    ->withInput();
                                    $download = $nameFile;
                                                     
                                                   
                                        $project = Project::create([
                                            'user_id' => auth()->id(),
                                            'title' => request('title'),
                                            'description' => request('description'),
                                            'type' => request('type'),
                                            'download' => $download,
                                            'path_web' => $path,
                                            'extension' => 'Site WEB',
                                            'file_type' => 0,
                                            'date' => $actDate,
                                            'project' => $nameFile,
                                            'views' => 0,
                                            'thumbnailURL' => $thumbnailURL
                                            
                                        ])->save();
                                        return response()->json(['success'=> "Sucesso, seu site foi enviado !!!"]);

                                   }else{
                                        Storage::delete('files/'. $nameFile);

                                        return response()->json(['success'=> " Arquivo index não encontrado!!!"]);

                                   }   
                            }
                      
                        }
                    }else{
                            return response()->json(['success'=> "Arquivo invalido!!!"]);
                    }
            }elseif($tipo == '1'){
                    if ($request->hasFile('file') && $request->file('file')->isValid()) 
                    {
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
                                     
                                   
                    $project = Project::create([
                        'user_id' => auth()->id(),
                        'title' => request('title'),
                        'description' => request('description'),
                        'type' => request('type'),
                        'download' => $download,
                        'file_type' => 1,
                        'extension' => 'Imagem',
                        'date' => $actDate,
                        'project' => $nameFile,
                        'views' => 0,
                        'thumbnailURL' => $thumbnailURL
                        
                    ])->save();
                    return response()->json(['success'=>'postagem feita com sucesso!!!']);
                }else{
                    return response()->json(['success'=>'imagem não suportada']);
                }
    
            }
        }catch(Exception $ex){
            
            return response()->json(['success' => 'Arquivo não suportado']);

        }
            return response()->json(['success'=>'Projeto enviado com sucesso.']);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $id, Request $request) //mostrar o projeto
    {

        $nomeSessao = 'viewProject-' . $id->id;
        $project= $id;

        if (!$request->session()->exists($nomeSessao)) {
            $project->views += 1;
            $project->save();

            $request->session()->put($nomeSessao, true);     
        }

        $like = Likes::where([
            ['user_id', Auth::id()],
            ['project_id', $project->id],
        ])->get();

        

        if($like->isEmpty()) {
            $temLike = 'Curtir';
        } else {
            $temLike = 'Descurtir';
        }

       return view('project.show')->with('project', $id)->with('temLike', $temLike); 
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
     
      

       

        /**
         * use Facade Storage
         * method delete image
         */
        try{
            //instancia os Likes e Commentarios para excluilos pelo id do projeto
            //para não haver erros de forenkey
            $comment = new Comment();
            $likes = new Likes();

            foreach($comment::where("project_id" , $id)->get() as $com){

              $com->delete();
            }
            foreach($likes::where("project_id" , $id)->get() as $like){
                $like->delete();
            }

           

            //deleta
            Storage::delete('files/'. Project::find($id)->project);
            //deleta projeto com id informado
            Project::find($id)->delete();

            //retorna a listagem  de projetos
            return redirect('projects');

        }catch(Exception $ex){
            return redirect()->back();
        }



    }


    public function pesquisaSent()
    {

    	$naoEnviados = Project::where(
            'sent', 0)->get();

    	$contador = $naoEnviados->count();

    	while ($contador > 0) {

    		$upload = $naoEnviados->where('sent', '0')->first->id;

            $arquivo = "storage/files/$upload->project";

       try {

            $video = Youtube::upload($arquivo, [
                'title'       => $upload->title,
                'description' => $upload->description,
                //'tags'        => $upload->title,
                'category_id' => $upload->type
            ]);
            $snippet = $video->getSnippet();
            $thumbnailURL = $snippet->thumbnails->high->url;
            $nameFile = $video->getVideoId();

            $upload->sent = '1';
            $upload->thumbnailURL = $thumbnailURL;
            $upload->project = $nameFile;
            $upload->save();

            unlink($arquivo);  
            
        } 
        catch(Exception $e)
        {
            dd($e);
        }
        }
        
    }
    public function callback(string $url){
        return Storage::url('web/'.$url.'/index.html');
    }

}