<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Yousent extends Command
{
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
                echo "A Fila não pode detectar video disponivel";
            }
        }
    }
}
