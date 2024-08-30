<?php 

class Session {

    public function __construct(){
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get ($key) {
        return isset($_SESSION[$key])? $_SESSION[$key]:null;
    }

    public function clear($key) {
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }
}