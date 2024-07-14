<?php 

    session_start();
    // session_unset();
    require_once __DIR__."/../../../vendor/autoload.php";
    require_once __DIR__."/../../../app/config/config.php";
    require_once __DIR__."/../../../app/config/function.php";

    $sess = new \app\Models\Sessions();
    $user = $sess->getUsers("user");
    if (!empty($user)) {
        $sess->pop("user");
        echo "It exist";
        header("Location: ../dashboard.php");
    }

?>