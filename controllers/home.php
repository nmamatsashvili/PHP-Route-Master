<?php
class home
{

    public function __construct() {
        error_log("home controller is initialized");
    }
    public static function getSum($var1, $var2){
        error_log("function getSum called!");
        return $var1 + $var2;
    }
    public function getTotalSum(){
        error_log("function getTotalSum called!");
    }
    public function _default(){
        error_log("this is default function call");
    }

    public function checkModel(){
        error_log("model response ".home_model::test_init());
    }

    public function queryTest(){
        $rsst = DB::Run("select *from subjects limit 0,1");
        var_dump($rsst);
        //alog($rsst, true);
    }
}