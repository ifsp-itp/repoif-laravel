<?php
namespace App;

use App\Dailymotion;
use Illuminate\Support\Str;
use App\DailymotionTransportException;

/**
 * @beforeClass
 * classe de upload para o  dailymotion
 */
class UploadDaily{
    // Account settings
    private $apiKey;
    private $apiSecret;
    private $testUser;
    private $testPassword;

    // Scopes you need to run your tests

    private $scopes;

    public function __construct() {
        $this->scopes = array(
        'userinfo',
        'feed',
        'manage_videos',
        );
        
        $this->setApiKey(env('CLIENT_DAILY', null));
        $this->setApiSecret(env('SECRET_DAILY', null));
        $this->setTestUser(env('USER_DAILY', null));
        $this->setTestPassword(env('PASSWORD_DAILY', null));


    

    }
    // Dailymotion object instanciation
    /**
     * @method mixed upload()
     * @param mixed $title titulo do video
     * @param mixed $file arquivo para upload
     * faz upload usando SDK Dailymotion
     */
    public function upload($title = "", $file = "") : array
    {
        //validação dos parametros
        if($title == "" || $file == ""){
            return ['error'=> 'não foi informado todos os parametros obrgatorios', 'status' => true];
        }
     
        try{
                //instacia da classe do SDK
                $api = new Dailymotion();
                
                //tempo de envio
                $this->time($api, 10000);

                //token api
                $api->setGrantType(
                    Dailymotion::GRANT_TYPE_PASSWORD,
                    $this->getApiKey(),
                    $this->getApiSecret(),
                    $this->scopes,
                    array(
                        'username' => $this->getTestUser(),
                        'password' => $this->getTestPassword(),
                    )
                );
                //formatação e fatiamento do caminho
                $res = $this->path($file);
                //upload video
                $url = $api->uploadFile($res);
                $result = $api->post(
                    '/videos',
                    array(
                        'url'       => $url,
                        'title'     => $title,
                        'tags'      => 'dailymotion,api,sdk',
                        'channel'   => 'videogames',
                        'published' => true,
                    )
                );
                //retornando o video
                /**'
                 * @return  array(video, status)
                 */
                return ['video' => $result, 'status' => true];
        }catch(DailymotionTransportException $ex){
            return ['error'=>  ['error', 'arquivo grande demorando enviar', 'status' => true]];
        }catch(Exception $ex){
            return ['error'=>  ['error', 'erro de analize do arquivo', 'status' => true]];
        }finally{
            dd($result);
        }
    }


    private function time($object, $time) : void{
        $object->timeout = $time;
        $object->connectionTimeout = $time;
    }
    private function path($file): string
    {
        $slice =  Str::replaceFirst('\\','//' ,$file);
        $teste = explode("\\", $slice);
        $final =  count($teste) - 1;
        $resul = 0;
        $res = "";
        foreach ($teste as $value) {
            if($final == $resul){
                $res = $res.$value;
            }else{
                $res = $res.$value."/";
            }
            $resul += 1;      
        }
        return $res;
    }
   private function getApiKey() {
        return $this->apiKey;
    }

   private function getApiSecret() {
        return $this->apiSecret;
    }

   private function getTestUser() {
        return $this->testUser;
    }

   private function getTestPassword() {
        return $this->testPassword;
    }

    private function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    private function setApiSecret($apiSecret) {
        $this->apiSecret = $apiSecret;
    }

    private function setTestUser($testUser) {
        $this->testUser = $testUser;
    }

    private function setTestPassword($testPassword) {
        $this->testPassword = $testPassword;
    }


}


