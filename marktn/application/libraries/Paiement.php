<?php
session_start();
class Paiement {
    private $CI;
    private $client_id;
    private $client_secret;
    private $util;
    private $site_url;
    private $return_url;
    private $notif_url;
    private $cancel_url;
    private $token=null;
    private $service;
    const URL_AUTH = "https://api.moobipay.com/token/auth";
    const URL_RESULTAT = "https://api.moobipay.com/v1/paiment-status";
    const URL_PAIEMENT =  "https://api.moobipay.com/v1/payment-init";
	
    /**
     * Paiement constructor.
     * @param $client_id
     * @param $client_secret
     * @param $authorization_code
     * @param $site_url
     * @param util $util
     */
    public function __construct($params){//$client_id, $client_secret, $authorization_code
        $this->CI = & get_instance();
        $this->service = $params['service'];
        $this->client_id = $params['client_id'];
        $this->client_secret = $params['client_secret'];
        $this->authorization_code = $params['authorization_code'];
        $this->site_url = "https://marketinona.com/";
        $this->return_url = "https://marketinona.com/achat/succes";
        $this->notif_url = "https://marketinona.com/achat/notification";
        $this->cancel_url = "https://marketinona.com/achat/erreur";
        $this->CI->load->library('util');
    }


    /**
     * @return mixed
     */
    private function getToken(){
        if($this->token!=null)return $this->token;
        $param=array(
            'client_id'=>$this->client_id,
            'client_secret'=>$this->client_secret,
            'authorization_code'=>$this->authorization_code
        );
        $json = $this->CI->util->sendCurl(self::URL_AUTH,"POST",array('Content-Type:application/json'),$param);
        
        $retour= json_decode($json);
        if(isset($retour->error)){
            throw new Exception($retour->status);
        }
        $this->token=$retour->access_token;
        
        return $retour->access_token;
    }
	
    /**
     * @param $url
     * @param array $params_{"unitto_send
     * @return bool|int|string
     */
    private function send($url,array $params){
        
        $headers=array("Authorization:Bearer ".$this->getToken());
        $json=$this->CI->util->sendCurl($url,"POST",$headers,$params);
        //echo $url;exit();
        

        $retour=json_decode($json);
        
       
        if(!empty($retour->error)){
            throw new Exception($retour->error);
        }
        return $retour;
    }


	/**
     * @param $idpanier
     * @param $montant
     * @param $nom
     * @param $reference
     * @param $adresseip
     * @return bool|int|string
     */
    public function initPaiement($order_id,$order_label,$amount){
        $now=new DateTime();
        $params=array(
            "currency"=>"MGA",
            "service"=>$this->service,
            "order_id"=>$order_id,
            "order_label"=>$order_label,
            "amount"=>$amount,
            "site_url"=>$this->site_url,
            "return_url" => $this->return_url,
            "notif_url" => $this->notif_url,
            "cancel_url" => $this->cancel_url
        );

		try{
			$pay_detail=$this->send(self::URL_PAIEMENT,$params);
           
            $_SESSION['pay_token'] = $pay_detail->pay_token;
            redirect($pay_detail->pay_url, 'refresh');
		}
		catch(Exception $e){
			log_message('error',$e->getMessage());
		}
		
    }

    /**
     * @param $idpaiement
     */
    public function resultPaiement($pay_token){
        log_message('error','resultPaiement');
        $params=array(
            "pay_token"=>$pay_token
        );
        $res=$this->send(self::URL_RESULTAT,$params);
        return $res;
    }

}