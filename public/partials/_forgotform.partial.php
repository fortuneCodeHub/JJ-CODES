<!-- Athentication form Begins -->
<section class="auth-form-bg">
    <div id="users" class="text-white"></div>
    <div class="auth-form-contain bg-dark" id="forgot-form">
        <h3 class="text-star fw-700 text-white mb-1">Forgot your password!</h3>
        <small class="text-start">Enter your email address to verify if your account exists</small>
        <form id="auth-form">
            <div class="row g-3">
                <?php if (empty($sess)) { ?>
                    <div class="col-12">
                        <label for="Email" class="form-label text-white">Email</label>
                        <div class="input-group" id="input-group">
                            <span class="input-group-text" id="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        </div>
                        <div id="emailErr" class="text-danger"></div>
                    </div>
                    <div class="col-12 py-2 px-2 auth-form-btn-bg">
                        <button class="py-2 fw-700" type="submit" id="sendMail">
                            Send Mail
                        </button>
                    </div>
                <?php } else { ?>
                    <?php if (isset($_GET["id"]) && $_GET["id"] == $sess["authId"]) { ?>
                        <div class="col-12">
                            <label for="password" class="form-label text-white">New Password</label>
                            <div class="input-group" id="input-group">
                                <span class="input-group-text" id="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" placeholder="****">
                            </div>
                            <div id="passwordErr" class="text-danger"></div>
                        </div>
                        <div class="col-12">
                            <label for="rptpassword" class="form-label text-white">Current Password</label>
                            <div class="input-group" id="input-group">
                                <span class="input-group-text" id="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="rptpassword" placeholder="****">
                            </div>
                            <div id="rptpasswordErr" class="text-danger"></div>
                        </div>
                        <div class="col-12 py-2 px-2 auth-form-btn-bg">
                            <button class="py-2 fw-700" type="submit" name="submit" id="changePWD">
                                Change password 
                            </button>
                        </div>
                    <?php } else { ?>
                        <div class="col-12">
                            <label for="OTP" class="form-label text-white">Input the OTP sent to your email here</label>
                            <div class="input-group" id="input-group">
                                <input type="text" class="form-control" id="otp" placeholder="OTP">
                            </div>
                            <div id="otpErr" class="text-danger"></div>
                        </div>
                        <div class="col-12 py-2 px-2 auth-form-btn-bg">
                            <button class="py-2 fw-700" type="submit" name="submit" id="checkOTP">
                                CHECK
                            </button>
                        </div>
                    <?php } ?>
                <?php } ?>

                
            </div>
        </form>
    </div>
</section>
<!-- Authentication form Ends -->