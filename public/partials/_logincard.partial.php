<!-- Athentication form Begins -->
<section class="auth-form-bg">
    <div id="users" class="text-white"></div>
    <div class="auth-form-contain bg-dark">
        <h3 class="text-center fw-700 text-white mb-1">Log In</h3>
        <form id="auth-form">
            <div class="row g-3">
                <div class="col-12">
                    <label for="Email" class="form-label text-white">Email</label>
                    <div class="input-group" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-at"></i></span>
                        <input type="text" class="form-control" id="email" placeholder="you@example.com">
                    </div>
                    <div id="emailErr" class="text-danger"></div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label text-white">Password</label>
                    <div class="input-group" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="****">
                    </div>
                    <div id="passwordErr" class="text-danger"></div>
                </div>
                <div class="col-12 py-2 px-2 auth-form-btn-bg">
                    <button class="py-2 fw-700" type="submit" name="submit" id="loginUser">
                        Log In
                    </button>
                </div>
                <div class="text-center">
                    <p class="text-white">
                        <a href="forgotpwd.php">Forgot password?</a>
                    </p>
                    <p class="me-1 text-white">Don't have an account? <a href="signup.php" style="text-decoration: none;" class="fw-600">SignUp</a></p>
                    <a href="index.html" style="text-decoration: none;" class="fw-600">&lt; Back</a>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Authentication form Ends -->