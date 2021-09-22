<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddMe</title>
    <!-- FAVIVON -->
    <link rel="shortcut icon" href="assets/icons/favico.png" type="image/png">
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- APP CSS -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="container">
        <div class="main-container">
            <div class="main-content">
                <div class="form-container">
                    <div class="form-content box">
                      <a href="index.php">
                        <div class="logo">
                            <img src="assets/icons/logo-fav.png" alt="Instagram logo" class="logo-light">
                            <img src="assets/icons/logo-fav.png" alt="Instagram logo" class="logo-dark">
                        </div>
                        </a>
                        <form  action="functions/login_check.php" method="post">
                        <div class="signin-form" id="signin-form">
                            <div class="form-group">
                                <div class="animate-input">
                                  <input type="text" name="uname"  placeholder="Vnesi username" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animate-input">
                                    <input type="password" name="pass"  placeholder="Vnesi geslo" required="required" />
                                    <button>Show</button>
                                </div>
                            </div>
                            <div class="btn-group">

                                    <input type="submit" class="btn-login" id="signin-btn" value="Prijava" />

                            </div>
                            </form>
                            <div class="divine">
                                <div></div>
                                <div>OR</div>
                                <div></div>
                            </div>
                            <div class="btn-group">
                                <button class="btn-fb">
                                    <img src="assets/icons/facebook-icon.png" alt="">
                                    <span>Log in with Facebook</span>
                                </button>
                            </div>
                            <div class="btn-group">
                                <button class="btn-gl">
                                    <img src="assets/icons/google_search_new_logo_icon_159150.png" alt="">
                                    <span>Log in with Google</span>
                                </button>
                            </div>
                            <a href="#" class="forgot-pw">Forgot password?</a>
                        </div>
                    </div>
                    <div class="box goto">
                        <p>
                            Don't have an account?
                            <a href="register-form.php">Sign up</a>
                        </p>
                    </div>


                </div>
            </div>
        </div>

        <div class="footer">
            <div class="links">
                <a href="#">About</a>
                <a href="#">Blog</a>
                <a href="#">Jobs</a>
                <a href="#">Help</a>
                <a href="#">API</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Top Accounts</a>
                <a href="#">Hashtags</a>
                <a href="#">Locations</a>
            </div>
            <div class="copyright">
                © 2021 AddMe
            </div>
        </div>
    </div>



</body>

</html>
