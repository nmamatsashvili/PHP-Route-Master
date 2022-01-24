<?php

class DB
{

    public static  $cfg = array(
        'encoding' => 'utf8',
        'collate' => 'utf8_general_ci'
    );
    public static  $conns = array();
    public static  $host_db;
    private static $host;
    private static $user = "";
    private static $pass = "";
    private static $defaultDB = "";
    public static $errorMessage = "";


    private static function conn($dbname)
    {
        self::$host_db = self::$host . $dbname;
        if (!array_key_exists(self::$host_db, self::$conns)) {
            try {
                self::$conns[self::$host_db] = new PDO('mysql:host=' . self::$host . ';dbname=' . $dbname, self::$user, self::$pass);
                self::$conns[self::$host_db]->exec("SET NAMES " . self::$cfg['encoding']);
            } catch (PDOException $e) {
                error_log(print_r($e->getMessage(), true));
            }
        }
    }


    public static function Run($query, $dbname = "", $params = NULL)
    {
        try {
            if( empty($dbname) )
                $dbname = self::$defaultDB;

            self::conn($dbname);

            if ($query === "beginTransaction") {
                self::$conns[self::$host_db]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conns[self::$host_db]->beginTransaction();
            } else if ($query === "rollback") {
                self::$conns[self::$host_db]->rollBack();
            } else if ($query === "commit") {
                self::$conns[self::$host_db]->commit();
            } else if ($query == "lastInsertId") {
                return self::$conns[self::$host_db]->lastInsertId();
            } else {

                $sth = self::$conns[self::$host_db]->prepare($query);
                if ($params === NULL)
                    $sth->execute();
                else
                    $sth->execute($params);


                if (strtoupper(substr($query, 0, 6)) === "SELECT")
                    return $sth->fetchAll(PDO::FETCH_ASSOC);
                else
                    return $sth->rowCount();
            }
        }
        catch (PDOException $ex){
            error_log(print_r($e->getMessage(), true));
            self::$errorMessage = $ex->getMessage();
            return false;
        }
    }
}