<?php
class Router{

	private $request;


	public function __construct($request){
		$this->request = $request;
	}

	public function startRouting(){

        $AllowedRequests = array("GET", "POST");
        if( !in_array($_SERVER['REQUEST_METHOD'], $AllowedRequests) ){
            error_log("request ".$_SERVER['REQUEST_METHOD']." is not accepted");
            return false;
        }


		$uri = trim( $this->request, "/" );
		$uri = explode("/", $uri);
        $initClass  = isset($uri[1]) && !empty($uri[1]) ? $uri[1] : "";
        $callMethod = isset($uri[2]) && !empty($uri[2]) ? $uri[2] : "";
        if(empty($initClass)){
            error_log("Empty class requested");
            return false;
        }

        if(!preg_match('/^[A-Za-z][A-Za-z0-9]+$/', $initClass)){ // regex allowed only text and number (starting with text only)
            error_log("class name does not match regular expression $initClass");
            return false;
        }
        if(!empty($callMethod) && !preg_match('/^[A-Za-z][A-Za-z0-9]+$/', $callMethod)){
            error_log("method name does not match regular expression $callMethod");
            return false;
        }

        if(mb_strlen($initClass) > 50){
            error_log("class name too long $initClass");
            return false;
        }

        if(mb_strlen($callMethod) > 50){
            error_log("method name too long $initClass");
            return false;
        }


        if( file_exists("controllers/$initClass.php") ){
            require_once  "controllers/$initClass.php";
        }
        else{
            error_log("requested file does not exists in controllers/$initClass.php");
            return false;
        }

        $classInstance = new $initClass;

        loadModel("models/$initClass"."_model");
        loadModel("shared/DB");
        //loadModel("shared/dbb");

        if( empty($callMethod) )
            $classInstance->_default();
        else
            $classInstance->$callMethod();

        return true;
	}

}