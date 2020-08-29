<?php

namespace App\Console\Commands;

//use App\Facades\Upload;
use Exception;
use App\Project;
use App\sentYoutube;
use App\UploadDaily;
//use Dawson\Youtube\Facades\Youtube;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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
    protected $description = 'envia videos para o provedor de video';

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
        while ($contador > 0) {
            $upload = $naoEnviados->where('sent', '0')->first->id;
            
            if($upload->type == 2){
                foreach (File::files("storage/app/public/files") as $value) {
                    if($value->getFilename() == $upload->project){ 
                        $file = $value;
                    }
                    
                }
             try {
                    //envia informações do banco
                    $resul = new UploadDaily($upload->title, $file);

                    $enviado = 1;
                    $nowDate = date('Y-m-d');
                    $project = $upload->update([
                        'sent' => $enviado,
                        'project' => $resul['id'],
                        'type' => 2,
                        'extension' => 'Video',
                        'date' => $nowDate
                    ]);
                
                    //gera log
                    $log = new sentYoutube();
                    $log->arquivo_log = "Enviado ".$resul['id'];
                    $log->save();

                    //mostra uma mensagem
                    echo "video ( ".$resul['id']." ) enviado sucesso!!!";
                    
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
