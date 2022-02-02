<?php
class Util {
    private $CI;

    /**
     * Util constructor.
     */
    public function __construct(){
        $this->CI = & get_instance();
    }


    public function sendCurl($url,$type,$headers,$params){

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST

        $payload = json_encode($params);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);
        return $result;
    }

    public function sendCurlSAVE($url,$type,$headers,$params){

        $curl=curl_init();
        //curl_setopt($curl, CURLOPT_PROXY, '127.0.0.1:8888');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        if(strtoupper($type)=='POST'){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$params);
        }else{
            $query=http_build_query($params);
            $url.="?".$query;
        }
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
        $result=curl_exec($curl);
        echo curl_error($curl);
        curl_close($curl);
        return $result;
    }
}