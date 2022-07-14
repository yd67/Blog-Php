<?php

namespace App\Tools ;

class Session
{
    public function __construct()
    {
        session_start();
    }
    public function full()
    {
        return $_SESSION ;
    }

    public function get($index)
    {
        // Accesses the superglobal directly
        return $_SESSION[$index];
    }

    public function write($index, $value)
    {
        // Accesses the superglobal directly
        $_SESSION[$index] = $value;
    }

    public function remove($index)
    {
        unset($_SESSION[$index]) ;
    }
}