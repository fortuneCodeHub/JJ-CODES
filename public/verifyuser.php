<?php

use app\Models\Sessions;
use app\Models\Users;

    session_start();
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../app/config/config.php";
    require_once __DIR__."/../app/config/function.php";

    $successMsg = "";
    $errorMsg = "";
    $information = "";
    $verifySuccess = "";

    $sess = new \app\Models\Sessions();
    $sess = $sess->getUsers("user");
    if (empty($sess["verifyph"])) {
        header("Location: index.php");
    }
    // var_dump($sess);


    if (isset($_GET["sesid"]) && !empty($_GET["sesid"])) {
        $information = "successful";
    } elseif (isset($_GET["tryAgain"]) && !empty($_GET["tryAgain"])) {
        $information = "tryAgain";

        // Instantiate session object
        $userSess = new Sessions();
        $userSess = $userSess->getUsers("user");


        if (!empty($userSess)) {
            // Instantiate email object
            $email = new \app\Models\Email();
            
            // write the url to the verify user page
            $url = (!empty($userSess)) ? ROOT_URL. "/verifyuser.php?verifyph=".$userSess["verifyph"]."&id=". $userSess["id"] : "";

            // this the file path to the email document for the email verification mail
            $filepath =  __DIR__."/../app/resources/EmailVerify.php";

            // This is the mail to verify the users email
            $message = emailPicker($filepath, $url);
            // $message = "Yes we've sent the email";
            $recipient = $userSess["email"];
            $subject = "Email Verification";

            // resend verification mail has been sent
            if ($email->send_mail($recipient, $subject, $message)) {
                $successMsg = "Email sent successfully";
            } else {
                $errorMsg = "Error while resending mail, check your email and try again later";
            }
        }

    } elseif (isset($_GET["verifyph"]) && isset($_GET["id"])) {
        $information = "verifyemail";

        // check the url for $_GET data
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $verifyPh = $_GET["verifyph"];

            // set the $data array
            $data["id"] = $id;
            $data["verifyph"] = $verifyPh;

            // Instantiate the Users class to get data from db
            $users = new Users();
            $user = $users->where(["id" => "$id"]);

            if (!empty($user)) {
                if ($verifyPh == $user["verifyph"]) {
                    $verifySuccess = "verified";

                    // Instantiate the sessions class
                    $userSess = new Sessions();

                    // Check if user session has been set before
                    if (!empty($userSess->getUsers("user"))) {
                        $userSess->pop("user");
                    }

                    // store user data to the session
                    $userSess->users($user,"user");
                }
            } else {
                $errorMsg = "Try again later or login";
            }
        } else {
            $errorMsg = "Invalid verification";
        }

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["resendMail"])) {

            // Instantiate session object
            $userSess = new Sessions();
            $userSess = $userSess->getUsers("user");

            if (!empty($userSess)) {
                // Instantiate email object
                $email = new \app\Models\Email();
                
                // write the url to the verify user page
                $url = (!empty($userSess)) ? ROOT_URL. "/verifyuser.php?verifyph=".$userSess["verifyph"]."&id=". $userSess["id"] : "";

                // this the file path to the email document for the email verification mail
                $filepath = __DIR__."/../app/resources/EmailVerify.php";

                // This is the mail to verify the users email
                $message = emailPicker($filepath, $url);
                // $message = "Yes we've sent the email";
                $recipient = $userSess["email"];
                $subject = "Email Verification";

                // resend verification mail has been sent
                if ($email->send_mail($recipient, $subject, $message)) {
                    $successMsg = "Email sent successfully";
                } else {
                    $errorMsg = "Error while resending mail, check your email and try again later";
                }
            }

        }
    }
?>
<?php include_once "layouts/head.layout.php" ?>
<?php include_once "components/navbar.component.php" ?>
<?php include_once "components/shownotify.component.php" ?>
<?php include_once "components/preloader.component.php" ?>
<div class="container" style="padding-bottom: 300px;padding-top: 100px;">
    <div class="text-center text-white bg-dark py-3 px-1">
        <?php if ($information == "successful") { ?>
            <p>
                A mail has been sent to your email, pls verify your email account.
            </p>
            <form method="post">
                <button type="submit" name="resendMail" class="btn btn-primary">
                    Resend Verification Mail
                </button>
            </form>
        <?php } elseif ($information == "tryAgain") { ?>
            <p>
                Unfortunately the verification email was not sent, please resend it verify your account
            </p> 
            <form method="post">
                <button type="submit" name="resendMail" class="btn btn-primary">
                    Resend Verification Mail
                </button>
            </form>
        <?php } elseif ($information == "verifyemail") { ?>
            <p class="text-center fw-bolder" style="font-size: 20px;">
                Verifying...
            </p> 
            <!-- <small class="text-danger fw-bold p-1">&#128712; Make sure you're verifying from the browser you signed up with</small> -->
        <?php } ?> 
    </div>
</div>
<?php include_once "components/footer.component.php" ?>
<?php include_once "layouts/bottom.layout.php" ?>

<script>
    <?php if (!empty($successMsg)) { ?>
        $("#showMsg").html(
            "<div class='alert alert-success alert-dismissible fade show' role='alert'><?=$successMsg?><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
        )
    <?php } elseif (!empty($errorMsg)) { ?>
        $("#showMsg").html(
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'><?=$errorMsg?><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
        )
    <?php } elseif (!empty($verifySuccess)) { ?>
        const preLoader = document.querySelector(".preloader")
        preLoader.style.display = "flex"
        setTimeout(() => {
            window.location.assign("backend/dashboard.php?login")
        }, 4000)
    <?php } ?>
</script>
