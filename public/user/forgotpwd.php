<?php 
    session_start();
    require_once __DIR__."/../../vendor/autoload.php";
    require_once __DIR__."/../../app/config/config.php";
    require_once __DIR__."/../../app/config/function.php";
    
    $users = new \app\Models\Users();
    $userSess = new \app\Models\Sessions();


    if ($users->checkEmail($_POST)) {
        // Set data 
        $data = $users->verifiedData;

        // Instantiate email object
        $email = new \app\Models\Email();
        
        // create the otp for the session
        $otp = rand(1000, 9999);
        $authId = "fpwd". rand(100000, 999999)."id";
        $otpSess["otp"] = $otp;
        $otpSess["authId"] = $authId;
        $otpSess["email"] = $data["email"];
        $otpSess["id"] = $data["id"];

        // this the file path to the email document for the email verification mail
        $filepath = __DIR__."/../../app/resources/OTPcode.php";

        // This is the mail to verify the users email
        $message = emailPicker($filepath, $otp);

        // $message = "Yes we've sent the email";
        $recipient = $data["email"];
        $subject = "OTP Code";
        
        if ($email->send_mail($recipient, $subject, $message)) {
            // Check if otp session has been set before
            if (!empty($userSess->getUsers("otpSess"))) {
                $userSess->pop("otpSess");
            }

            // store otp to the session
            $userSess->users($otpSess,"otpSess");
            
            $users->success = "The email has been sent";

        } else {
            $users->tryAgain = true;
        }
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
        setTimeout(() => {
            window.location.assign("forgotpwd.php")
        }, 3000)
    <?php } elseif ($users->tryAgain) { ?>
        $("#showMsg").html(
            "<div class='alert alert-danger text-black alert-dismissible fade show' role='alert'>The email could not be sent, try again later<span type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></span></div>"
        )
    <?php } ?>
</script>