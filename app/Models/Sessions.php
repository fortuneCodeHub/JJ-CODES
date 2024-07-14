<?php

namespace app\Models;

class Sessions 
{
    public function __construct()
    {
        // return session_start();
    }

    public function users($data, $key)
    {
        if (!empty($data)) {
            if (is_array($data)) {
                $_SESSION[$key] = $data;
                return true;
            } else {
                $_SESSION[$key] = $data;
                return true;
            }
        } 
        return false;
    }

    public function getUsers($key) :mixed
    {
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function getAllSess()
    {
        if (!empty($_SESSION)) {
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
        } else {
            return false;
        }
    }

    public function pop($key)
    {
        if (!empty($_SESSION[$key]) && isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        } else {
            return false;
        }   
    }

}

