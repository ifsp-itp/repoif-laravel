<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GithubExemploController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRepositories($repository)
    {
        if(env("USER_GITHUB") != ""){
            $user = "repos/".env("USER_GITHUB");
        }else{
            dd(['error'=>'erro na variavel de ambiente']);
        }
       
        $repo = "/".$repository;
        if($repo != '' && $user != ''){
            try{
                $repository = "https://api.github.com";
                $client = new Client(['base_uri' => $repository, 'timeout' => 30.0]);
                $response = $client->request('GET', "$user$repo");
                $data = json_decode($response->getBody()->getContents());
                echo "<pre>";
                print_r($data);
                echo "</pre>";
                
               
                echo "<h1>GitHub</h1>";
                echo "<figure>";
                echo "<img src='".$data->owner->avatar_url."' alt='teste'>";
                echo "<figcaption>";
                    echo "";
                echo"</figcaption>";
                    
              
              

            }catch(Exception $ex){
                echo "foi excedido o tempo de conexão com o github";
            }
           

         


            //dd($response);
           
    }

}
}