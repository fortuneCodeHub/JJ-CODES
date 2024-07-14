<?php
session_start();
require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../../app/config/config.php";
require_once __DIR__."/../../app/config/function.php";

$users = new \app\Models\Users();

// Instantiate the sessions class
$userSess = new \app\Models\Sessions();

// if ($userSess->getUsers("user")) {
//     $sess = $userSess->getUsers("user");
// }

if ($users->createUser($_POST)) {
    // Get the data
    $data = $users->verifiedData;
    $email = $data["email"];

    // get the users id from the DB 
    $user = $users->where(["email" => "$email"]);

    if (!empty($user)) {
        $data["id"] = $user["id"];

        // Instantiate email object
        $email = new \app\Models\Email();
        
        // write the url to the verify user page
        $url = (!empty($userSess)) ? ROOT_URL. "/verifyuser.php?verifyph=".$data["verifyph"]."&id=". $data["id"] : "";

        // this the file path to the email document for the email verification mail
        $filepath = __DIR__."/../../app/resources/EmailVerify.php";

        // This is the mail to verify the users email
        $message = emailPicker($filepath, $url);
        // $message = "Yes we've sent the email";
        $recipient = $data["email"];
        $subject = "Email Verification";

        // echo $message;
        
        // create an id for the session
        $id = "sesi".rand(100000, 9999999)."d";
        $data["sesid"] = $id;
        
        // Check if user session has been set before
        if (!empty($userSess->getUsers("user"))) {
            $userSess->pop("user");
        }

        // store user data to the session
        $userSess->users($data,"user");

        // var_dump($userSess->getUsers("user"));
        
        // check if verification mail has been sent
        if ($email->send_mail($recipient, $subject, $message)) {
            $users->success = "User created successfully";
        } else {
            $users->tryAgain = true;
        }
    }

} else {
    $users->error .= "<br> User could not be created";
}

// echo $file ? "It exists" : "It does not exist";

?>



<script>
    <?php if (!empty($users->error)) { ?>
        $("#showMsg").html(
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'><?=$users->error?><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
        )
    <?php } elseif (!empty($users->success)) { ?>
        // to reset the form after a post
        $("#auth-form")[0].reset();
        setTimeout(() => {
            window.location.assign("verifyuser.php?sesid=<?=$_SESSION["user"]["sesid"] ?? ''?>")
        }, 3000)
    <?php } ?>

    <?php if ($users->tryAgain) { ?>
        // to reset the form after a post
        $("#auth-form")[0].reset();
        window.location.assign("verifyuser.php?tryAgain=yes")
    <?php }?>
</script>