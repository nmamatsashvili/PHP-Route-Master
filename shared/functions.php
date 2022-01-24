<?php


function loadModel($className) {

    $f =__DIR__ ."/". $className . '.php';

    if (!is_readable($f)) {
        errPage("Fatal error. Could not load class {$f}");
    }
    require_once($f);
}




function error404() {
    header("Status: 404 Not Found");
    header("HTTP/1.0 404 Not Found");
    echo "error 404";
/*
    REG::set("_curTemplate", 'error_404');

    echo file_get_contents(dirname(__FILE__) . "/../../errors/404.html");
    KERNEL::stop();*/
}




function errPage($msg) {
    die($msg);
}



function alog($mixed, $withBackTrace = false) {



    if($withBackTrace){
        error_log(print_r(debug_backtrace(), true));
//        $backtrace = debug_backtrace();
//        $called_from = "A log below from ".$backtrace[0]['file']." -------- on line: ".$backtrace[0]['line'];
//        error_log(print_r($called_from, true));

    }

    if (is_array($mixed)) {
        error_log(print_r($mixed, true));
    } else
        error_log($mixed);

    /*$dbt=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
    $caller = isset($dbt[1]['function']) ? $dbt[1]['function'] : null;
    error_log("there is caller: ".$caller);*/
}



function getArr($errorCode, $errorText, $data = null){
    return array( "error_code" => $errorCode, "error_text" => $errorText, "data" => $data) ;
}

function recursiveClearRequestParams($data){

    array_walk_recursive($data,'DoWalk');

    return $data;
}

function DoWalk(&$item, $key){
    $item = clearParams($item);
}



function clearParams($param) {
    $param = trim($param);
    $param = str_replace("'", "\'", $param);
    $param = str_replace('"', '\"', $param);


    //$param = str_replace("*/", "", $param);
    //$param = str_replace("/*", "", $param);
    /*
    $param = str_replace("--", "", $param);
    $param = str_replace("#", "`#`", $param);
    $param = str_replace(";", ".", $param);

    if(strpos($param,'delete') !== false) {
        $param = str_ireplace("delete", "`delete`", $param);
    }

    if(strpos($param,'insert') !== false) {
        $param = str_ireplace("insert", "`insert`", $param);
    }

    if(strpos($param,'update') !== false) {
        $param = str_ireplace("update", "`update`", $param);
    }
*/
    return $param;
}





?>