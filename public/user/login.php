<?php
session_start();
require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../app/config/config.php";
require_once __DIR__."/../../app/config/function.php";

$users = new \app\Models\Users();

if ($users->loginUser($_POST)) {
    // Create session
    $sess = new \app\Models\Sessions();
    
    if ($sess->getUsers("user")) {
        $sess->pop("user");
    }

    // Set new user session
    $data = $users->verifiedData;
    $newData["id"] = $data["id"];
    $sess->users($newData, "user");

    // Login user
    $users->success = "Successful login";
} else {
    $users->error .= "<br> Invalid login"; 
}

?>



<script>
    <?php if (!empty($users->error)) { ?>
            $("#showMsg").html(
            "<div class='alert alert-danger text-black alert-dismissible fade show' role='alert'><?=$users->error?><span type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></span></div>"
        )
    <?php } elseif (!empty($users->success)) { ?>
        setTimeout(() => {
            $("#showMsg").html(
            "<div class='alert alert-success text-black alert-dismissible fade show' role='alert'><?=$users->success?><span type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></span></div>"
            )
        }, 2000)
        // to reset the form after a post
        $("#auth-form")[0].reset();
        setTimeout(() => {
            window.location.assign("backend/dashboard.php?login")
        }, 6000)
    <?php } ?>
</script>
