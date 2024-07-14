<?php 
    session_start();
    // session_unset();
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../app/config/config.php";
    require_once __DIR__."/../app/config/function.php";

    $sess = new \app\Models\Sessions();
    $sess = $sess->getUsers("otpSess");
    // if (empty($sess)) {
    //     header("Location: ../index.php");
    // }
?>
<?php include_once "layouts/head.layout.php" ?>

  <?php include_once "components/shownotify.component.php" ?>

  <?php include_once "components/form-preloader.component.php" ?>
    
  <?php include_once "components/navbar.component.php" ?>

  <?php include_once "partials/_forgotform.partial.php" ?>

<?php include_once "layouts/bottom.layout.php" ?>
