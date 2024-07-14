<?php

$foldername = "JJ-CODES";
define("APPNAME", "JJ-CODES");
if ((!empty($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] == "localhost")) {
    define("DBNAME", "jj-comz");
    define("DBHOST", "localhost");
    define("DUSER", "root");
    define("DPASS", "");
    define("DDRIVER", "");

    // This is the ROOT_URL config
    $url = "http://localhost/$folder/public";
    define("ROOT_URL", $url);
} else {
    define("DBNAME", "");
    define("DBHOST", "");
    define("DUSER", "");
    define("DPASS", "");
    define("DDRIVER", "");

    define("ROOT_URL", "https://www.yourwebsite.com/public");
}