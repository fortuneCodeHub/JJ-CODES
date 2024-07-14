<?php 
    session_start();
    require_once __DIR__."/../../vendor/autoload.php";
    require_once __DIR__."/../../app/config/config.php";
    require_once __DIR__."/../../app/config/function.php";
    
    $users = new \app\Models\Users();
    $userSess = new \app\Models\Sessions();

    if (!empty($userSess->getUsers("otpSess"))) {
        // Get otpsession data
        $otpSess = $userSess->getUsers("otpSess");
        $otp = $otpSess["otp"];

        // get otp from $_post
        $postOtp = $_POST["otp"];

        // var_dump($otpSess);
        // echo "<br> $postOtp";


        if ($otp == $postOtp) {
            $users->authChange = true;
        } else {
            $users->error = "The OTP code is wrong, please try again 2";
            // echo $users->error;
        }
    } else {
        $users->error = "The OTP code is wrong, please try again 1";
        // echo $users->error;
    }
?>

<script>
    <?php if (!empty($users->error)) { ?>
            $("#showMsg").html(
            "<div class='alert alert-danger text-black alert-dismissible fade show' role='alert'><?=$users->error?><span type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></span></div>"
        )
    <?php } elseif ($users->authChange) { ?>
            // $("#showMsg").html(
            //     `<div class='alert alert-danger text-black alert-dismissible fade show' role='alert'>
            //     <?php // var_dump($_SESSION["otpSess"]) ?><span type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></span></div>`
            // )
            setTimeout(() => {
                window.location.assign("forgotpwd.php?id=<?=$_SESSION["otpSess"]["authId"] ?? ''?>")
            }, 2000)
    <?php } ?>
</script>