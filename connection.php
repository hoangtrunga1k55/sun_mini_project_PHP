<?php
class connection{
    public static  $__conn;
    public static function connectDb(){
        if (!self::$__conn){
            $serverName = "localhost";
            $userName = "pmauser";
            $passWord = "admin123";
            $dbName = "sun_login";
            self::$__conn = new mysqli($serverName, $userName, $passWord, $dbName);
        }
        return self::$__conn;
    }

    public static function disconnect(){
        self::$__conn->close();
    }
}