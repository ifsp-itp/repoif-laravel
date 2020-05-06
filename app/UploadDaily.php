<?php
namespace App;

use App\Dailymotion;
use Illuminate\Support\Str;

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
        
        $this->setApiKey(env('CLIENT_DAILY'));
        $this->setApiSecret(env('SECRET_DAILY'));
        $this->setTestUser(env('USER_DAILY'));
        $this->setTestPassword(env('PASSWORD_DAILY'));


    

    }
    // Dailymotion object instanciation

    public function upload($title = "", $file = ""){
        $api = new Dailymotion();

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
        return $result;
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