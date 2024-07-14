<!-- Athentication form Begins -->
<section class="auth-form-bg">
    <div id="users" class="text-white"></div>
    <div class="auth-form-contain bg-dark">
        <h3 class="text-center fw-700 text-white mb-1">Sign Up</h3>
        <form id="auth-form">
            <div class="row g-3">
                <div class="col-sm-6" id="input-group">
                    <label for="firstName" class="form-label text-white">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="">
                    <div id="firstNameErr" class="text-danger"></div>
                </div>
                <div class="col-sm-6" id="input-group">
                    <label for="lastName" class="form-label text-white">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="">
                    <div id="lastNameErr" class="text-danger"></div>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label text-white">Username</label>
                    <div class="input-group has-validation" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div id="usernameErr" class="text-danger"></div>
                </div>
                <div class="col-12">
                    <label for="Email" class="form-label text-white">Email</label>
                    <div class="input-group has-validation" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-at"></i></span>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    </div>
                    <div id="emailErr" class="text-danger"></div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label text-white">Password</label>
                    <div class="input-group has-validation" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="****">
                    </div>
                    <div id="passwordErr" class="text-danger"></div>
                </div>
                <div class="col-12">
                    <label for="confirm_password" class="form-label text-white">Confirm Password</label>
                    <div class="input-group has-validation" id="input-group">
                        <span class="input-group-text" id="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="confirm_password" placeholder="****">
                    </div>
                    <div id="confirm_passwordErr" class="text-danger"></div>
                </div>
                <div class="col-12 py-2 px-2 auth-form-btn-bg">
                    <button class="py-2 fw-700" type="submit" name="submit" id="addUser">
                        Sign Up
                    </button>
                </div>
                <div class="text-center">
                    <p class="me-1 text-white">Already have an account? <a href="login.php" style="text-decoration: none;" class="fw-600">LogIn</a></p>
                    <a href="index.html" style="text-decoration: none;" class="fw-600">&lt; Back</a>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Authentication form Ends -->