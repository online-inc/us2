<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');
		
class CurlDomainApi extends MY_Controller{

    public function index(){
        
    }

    public function getDomain($domainName){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$domainName);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        // echo "<pre>";

        $array = json_decode($result,true);
            // echo $name.'<br>';
            return($array);
            // echo "</pre>";
        curl_close($ch);

    }

}