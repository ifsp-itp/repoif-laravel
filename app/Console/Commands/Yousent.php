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

    /*
    *criar variavel CRON_YOUTUBE_PATH 
    *no arquivo .env e colocar o path do caminho 
    *até seus arquivos
    *ex: meus arquivos estão storage/files ou storage/app/public/files
    *ou caso seu arquivo esteja executando em um servidor [caminho absoluto] caminho completo
    *até a pasta de seus arquivos
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
    protected $description = 'envia arquivo spara o youtube';

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

        //acha videos não enviados
        $naoEnviados = Project::where(
        'sent', 0)->get();
        $contador = $naoEnviados->count();

        //looping que envia videos
        while ($contador > 0) {

            $upload = $naoEnviados->where('sent', '0')->first->id;
         
            //verifica se éum video [type igual a 2]
            if($upload->type == 2){
                //caminho do arquivo presente dentro de storage/files
                foreach (File::files(env('CRON_YOUTUBE_PATH')) as $value) {
                    //acha video na pasta
                    if($value->getFilename() == $upload->project){
                        $file = $value;
                    }
                }
             try {
                    //faz upload
              
                    $video = Youtube::upload($file, [
                        'title'       => $upload->title,
                        'description' => $upload->description,
                        'tags'        => ['foo', 'bar', 'baz'],
                        'category_id' => $upload->type
                    ]);
                    //busca dados do youtube
                    $snippet = $video->getSnippet();
                    $thumbnailURL = $snippet->thumbnails->high->url;
                    $nameFile = $video->getVideoId();
                    
                    //update dos dados do youtube
                    $upload->sent = '1';
                    $upload->thumbnailURL = $thumbnailURL;
                    $upload->project = $nameFile;
                    $upload->save();

                    echo "video ( ".$nameFile." ) enviado sucesso!!!\n";
                    
                    //update video
                    $naoEnviados = Project::where(
                        'sent', 0)->get();
                    $contador = $naoEnviados->count();
                } 
                catch(Exception $e)
                {
                    dd($e);
                    
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
