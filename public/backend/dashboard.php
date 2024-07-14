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
                        <h3 class="text-white fw-700">Dashboard</h3>
                        <small class="text-white">Welcome <i class="bi bi-emoji-smile-fill fw-600" style="color: gold;"></i> to your dashboard @<?=$user["username"]?></small>
                    </div>
                </div>
                <div class="row g-4 mt-3">
                    <div class="col-lg-6 col-12 paid-courses mt-3 mb-2 order-last order-lg-first">
                        <div class="bg-black p-3 paid-bg">
                            <h3 class="fw-600 text-white">Paid Courses</h3>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="play-bg" style="background-image: url(../image/lvimg.png);">
                                              <i class="bi bi-play-circle-fill"></i>  
                                            </div>
                                        </td>
                                        <td>Learn Laravel 2024 ...</td>
                                        <td>
                                            <a href="" class="fw-600">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <div class="play-bg" style="background-image: url(../image/phpimg.png);">
                                              <i class="bi bi-play-circle-fill"></i>  
                                            </div>
                                        </td>
                                        <td>Learn PHP 2024 ...</td>
                                        <td>
                                            <a href="" class="fw-600">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <div class="play-bg" style="background-image: url(../image/cssimg.png);">
                                              <i class="bi bi-play-circle-fill"></i>  
                                            </div>
                                        </td>
                                        <td>Learn CSS 2024 ...</td>
                                        <td>
                                            <a href="" class="fw-600">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <div class="play-bg bg-white" style="background-image: url(../image/gitimg.png);">
                                              <i class="bi bi-play-circle-fill"></i>  
                                            </div>
                                        </td>
                                        <td>Learn GitHub 2024 ...</td>
                                        <td>
                                            <a href="" class="fw-600">View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <div class="play-bg" style="background-image: url(../image/jsimg.png);">
                                              <i class="bi bi-play-circle-fill"></i>  
                                            </div>
                                        </td>
                                        <td>Learn JavaScript 2024 ...</td>
                                        <td>
                                            <a href="" class="fw-600">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 courses mt-3 mb-2">
                        <div class="bg-black p-3 d-flex flex-column">
                            <div class="buy-course b-radius-10">
                                <div class="d-flex flex-column">
                                    <div class="buy-head text-white">
                                        <span><i class="bi bi-play-btn me-2"></i></span>
                                        <span>Buy A Course Now</span>
                                        <br>
                                        <small class="text-success">
                                            <i class="bi bi-info-circle me-1"></i>
                                            buy a course today and stand a chance to get two free courses
                                        </small>
                                    </div>
                                    <div class="button-div">
                                        <a href="payment.php" class="d-flex align-items-center justify-content-between b-radius-10">
                                            <span>View Our Courses</span>
                                            <span><i class="bi bi-arrow-right-circle-fill"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-course b-radius-10">
                                <div class="d-flex flex-column">
                                    <div class="post-head text-white">
                                        <span><i class="bi bi-patch-plus-fill me-2"></i></span>
                                        <span>Post A Course</span>
                                        <br>
                                        <small class="text-danger">
                                            <i class="bi bi-info-circle me-1"></i>
                                            You can't perform this action because you are not the admin.
                                        </small>
                                    </div>
                                    <div class="button-div">
                                        <a href="" class="d-flex align-items-center justify-content-between b-radius-10">
                                            <span>Post A Course</span>
                                            <span><i class="bi bi-arrow-right-circle-fill"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-3">
                    <div class="col-lg-4 col-12 courses mt-3 mb-2">
                        <div class="d-flex flex-column">
                            <div class="check-course b-radius-10 bg-black">
                                <div class="d-flex flex-column">
                                    <div class="check-head text-white">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <span><i class="bi bi-clipboard-check me-2"></i></span>
                                                <span>Wishlist</span>
                                            </div>
                                            <span>2</span>
                                        </div>
                                    </div>
                                    <div class="button-div">
                                        <a href="" class="d-flex align-items-center justify-content-between b-radius-10">
                                            <span>View Wishlist</span>
                                            <span><i class="bi bi-arrow-right-circle-fill"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="check-course b-radius-10 bg-black">
                                <div class="d-flex flex-column">
                                    <div class="check-head text-white">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <span><i class="bi bi-cart4 me-2"></i></span>
                                                <span>Cart</span>
                                            </div>
                                            <span>0</span>
                                        </div>            
                                    </div>
                                    <div class="button-div">
                                        <a href="" class="d-flex align-items-center justify-content-between b-radius-10">
                                            <span>View Cart</span>
                                            <span><i class="bi bi-arrow-right-circle-fill"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 courses mt-3 mb-2">
                        <div class="bg-black p-3 paid-bg">
                            <div class="fw-600 text-white d-flex align-items-center justify-content-between">
                                Transactions 
                                <a href="" class="fw-600">View</a>
                            </div>
                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <hr>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            12N278
                                        </td>
                                        <td>Learn Laravel 2024 ...</td>
                                        <td>
                                            <div class="badge bg-success text-white">Paid</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            12BN78
                                        </td>
                                        <td>Learn PHP 2024 ...</td>
                                        <td>
                                            <div class="badge bg-success text-white">Paid</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            N21278
                                        </td>
                                        <td>Learn CSS 2024 ...</td>
                                        <td>
                                            <div class="badge bg-success text-white">Paid</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            N278BN
                                        </td>
                                        <td>Learn Gitdub 2024 ...</td>
                                        <td>
                                            <div class="badge bg-success text-white">Paid</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            N278JGH
                                        </td>
                                        <td>Learn JavaScript 2024 ...</td>
                                        <td>
                                            <div class="badge bg-success text-white">Paid</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once "layout/bottom.layout.php" ?>