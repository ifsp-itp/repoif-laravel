<?php

namespace App\Console\Commands;

use Exception;
use App\Project;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\Storage;

class Yousent extends Command
{

    /**
    *@trhed esse arquivo será executado
    *como tarefa para fila do youtube
    *@bloco é o abre e fecha de chaves "{ //code... }"
    *@method handle executa o script dentro de seu bloco
    */


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yousent:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envia videos para o youtube';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       
        $naoEnviados = Project::where('sent', 0)->get(); //acha videos não enviados com sent igual a 0
        $contador = $naoEnviados->count();//conta a quantidade de videos achados 

        
        while ($contador > 0) {//se haver pelo um video encontrado, começa a funcionar o looping que envia videos

            $upload = $naoEnviados->where('sent', '0')->first->id;//seleciona o primeiro video encontrado
        
            if($upload->type == 2){//verifica se aquele registro é realmente um video
                //acessa a pasta files no diretorio storage que fica na pasta public
                foreach (File::files("storage/files") as $value) {//foreach percorre toda a pasta
                    /*
                    e quando o nome do arquivo for igual a o video presente dentro da variavel $upload
                    */
                    if($value->getFilename() == $upload->project){ 
                        $file = $value;//quando achar o arquivo sera guardado dentro da variavel $file
                    }
                }
             try {
                    //faz upload do video
                    $video = Youtube::upload($file 
                    /* 
                    uma modificação da fila foi que agora o arquivo enviado agora é a mesma instancia 
                    do arquivo presente $request->file('file') que está no metodo store() do controlador
                    ProjectController.php
                    */, [
                        'title'       => $upload->title,
                        'description' => $upload->description,
                        //'tags'        => ['foo', 'bar', 'baz'],
                        'category_id' => $upload->type
                    ]);
                    //busca dados do youtube
                    $snippet = $video->getSnippet();
                    $thumbnailURL = $snippet->thumbnails->high->url;
                    $nameFile = $video->getVideoId();
                    
                    //atualiza dos dados do youtube
                    $upload->sent = '1';
                    $upload->thumbnailURL = $thumbnailURL;
                    $upload->project = $nameFile;
                    $upload->save();
                    //gera log
                    $log = new sentYoutube();
                    $log->arquivo_log = $nameFile;
                    $log->save();

                    //mostra uma mensagem
                    echo "video ( ".$nameFile." ) enviado sucesso!!!";
                    
                    /*
                    atualiza a variavel $nãoEnviados e a $contador
                    como agora o video feito upload tem sent igual a 1
                    ele não sera contado
                    */
                    $naoEnviados = Project::where('sent', 0)->get();
                    $contador = $naoEnviados->count();
                } 
                catch(Exception $e)
                {
                    //quando não for mais possivel enviar videos
                    //mostra mensagem
                    echo "A Fila não pode continuar uploads \n";
                    break;
                    //sai do looping
                    
                }
            }
        
          

            
        }
    }
}
