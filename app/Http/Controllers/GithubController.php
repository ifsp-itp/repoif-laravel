<?php

namespace App\Http\Controllers;

use Exception;
use App\Project;
use ZanySoft\Zip\Zip;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use \Symfony\Component\HttpFoundation\File\UploadedFile;

class GithubController extends Controller
{
    public function indexRepositories()
    {
        return view('github.github');
    }

    public function getRepositories(Request $repository)
    { 
        try{
            if(Storage::makeDirectory("files")){
                if(Storage::makeDirectory("tmp")){
                    if(($repository->user != "") && ($repository->repos != "")){
                        $actDate = date('Y-m-d');
                        $user = "repos/".$repository->user;
                        $repo = "/".$repository->repos;
                        $description = $repository->description;
                        $repos = $repository->repos;
                        $use = $repository->user;
                
                        //download
                        $url = "https://github.com/".$repository->user."/".$repository->repos."/archive/master.zip";
                        $info = pathinfo($url);
                        $contents = file_get_contents($url);
                        $file = public_path('storage\tmp\\').$info['basename'];
                        file_put_contents($file, $contents);
                        $upload_file = new UploadedFile($file, $info['basename']);
                
                        //processo integração
                        //validação do site
                        $hash = uniqid(date('HisYmd'));
                        $zipname = 'master'.$hash.'.zip';
                        $iszip = Storage::move('tmp/master.zip', 'files/'.$zipname);
                        if($iszip){
                            foreach(Zip::open('storage/'.'files/'.$zipname)->listFiles() as $file){
                                $teste[] =  explode('/' , $file);
                            }
                            $isExists = false;
                            foreach($teste as $index){
                                if(!empty($index[1])){
                                    if($index[1] == "index.html"){
                                        $isExists = true;
                                    }
                                }
                            }

    
                        if($isExists == true){
                            if(Zip::open('storage/'.'files/'.$zipname)->extract("storage/web/$zipname")){
                                    $path = "/storage/web/$zipname/$repository->repos-master";  
                            }
                                        
                            $repository = "";

                            $repository = "http://api.github.com";
                            $client = new Client(['base_uri' => $repository, 'timeout' => 100000000000000000000000000.0]);
                            $response = $client->request('GET', "$user$repo");
                            $data = json_decode($response->getBody()->getContents());

                            //path download
                            $download = $zipname;
                                        
                                    
                            $project = Project::create([
                                'user_id' => auth()->id(),
                                'title' => $repos,
                                'description' => $description,
                                'type' => 3,
                                'download' => $download,
                                'path_web' => $path,
                                'extension' => 'Site WEB GitHub',
                                'file_type' => 0,
                                'date' => $actDate,
                                'project' => $download,
                                'views' => 0
                                
                            ])->save();
                            return view('github.github',['success'=> "Sucesso, seu site foi enviado !!!", 
                                                    'repos' => [
                                                        'repository' => $data->owner->avatar_url,
                                                        'user' => $use
                                                        ]
                            ]);
                
                        }else{
                                Storage::delete('files/'. $zipname);
                
                                return view('github.github', ['success'=> " Arquivo index não encontrado!!!"]);
                
                        }
                
                    }
                
                    }else{
                        return view('github.github', ['success'=>'campos não informados!!!']);
                    }  
                }
            }
        }catch(Exception $ex){

            return view('github.github', ['success'=>'erro no carregamento do repositorio ou o repositorio é privado']);
            
        }
    }
}