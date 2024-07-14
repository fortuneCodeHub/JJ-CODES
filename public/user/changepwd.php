<?php 
    session_start();
    require_once __DIR__."/../../vendor/autoload.php";
    require_once __DIR__."/../../app/config/config.php";
    require_once __DIR__."/../../app/config/function.php";
    
    $users = new \app\Models\Users();
    $userSess = new \app\Models\Sessions();
    $otpData = $userSess->getUsers("otpSess");

    if ($users->checkPWD($_POST)) {
        // get all the posted data
        $data = $users->verifiedData;

        // get password value
        $password = password_hash($data["password"], PASSWORD_DEFAULT);

        // get session id 
        $id = $otpData["id"];
        $newData["password"] = $password;

        // var_dump($data);

        if ($users->update($newData, $id)) {
            if ($userSess->pop("otpSess")) {
                $users->success = "Successfully changed your password";
            }
        } else {
            $users->error = "Could not change password";
        }

    } else {
        $users->error .= "<br> Empty fields";
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
        }, 1000)
        // to reset the form after a post
        // $("#auth-form")[0].reset();
        setTimeout(() => {
            window.location.assign("login.php")
        }, 6000)
    <?php } ?>
</script>