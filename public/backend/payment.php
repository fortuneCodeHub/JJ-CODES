<?php

    use app\Models\Users;

    session_start();
    // session_unset();
    require_once __DIR__."/../../vendor/autoload.php";
    require_once __DIR__."/../../app/config/config.php";
    require_once __DIR__."/../../app/config/function.php";

    $sess = new \app\Models\Sessions();
    $sess = $sess->getUsers("user");
    if (empty($sess)) {
        header("Location: ../index.php");
    }

    $user = new \app\Models\Users();
    $user = $user->where(["id" => $sess["id"]]);
?>
<?php include_once "layout/head.layout.php" ?>
    <?php include_once "component/navbar.component.php" ?>
        <div class="row">
            <?php include_once "component/sidebar.component.php" ?>
            <div class="col-lg-9 col-12 mt-md-0 mt-4 desc-area">
                <div class="bg-black dash-head shadow">
                    <div class="p-3">
                        <h3 class="text-white fw-700">Make Payment</h3>
                    </div>
                </div>
            </div>
        </div>
<?php include_once "layout/bottom.layout.php" ?>