<?php
include_once 'functions/session.php';
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
                        <form  action="functions/registration-check.php" method="post">
                        <div class="signin-form" id="signin-form">
                            <div class="form-group">
                              <div >
                                <?php if (isset($_GET['error'])) { ?>
                                   <p class="error-r"><?php echo $_GET['error']; ?></p>
                                 <?php } ?>
                              </div>
                                <div class="animate-input">
                                  <?php if (isset($_GET['em'])) { ?>
                                    <input type="email" name="email"  placeholder="Email" autocomplete="off" value="<?php echo $_GET['em'] ?>"/>
                                  <?php }else{ ?>
                                  <input type="email" name="email"  placeholder="Email" autocomplete="off"/>
                                  <?php } ?>
                                </div>
                                <div class="divine-reg">
                                    <div>OR</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animate-input">
                                    <?php if (isset($_GET['tl'])) { ?>
                                      <input type="text" name="telefon" placeholder="Telephone" autocomplete="off" maxlength="9" value="<?php echo $_GET['tl'] ?>"/>
                                    <?php }else{ ?>
                                    <input type="text" name="telefon" placeholder="Telephone" autocomplete="off" maxlength="9"/>
                                    <?php } ?>
                                    <div class="divine-reg-1">
                                        <div> </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group" id="odmik">
                                <div class="animate-input">
                                  <?php if (isset($_GET['na'])) { ?>
                                    <input type="text" name="name"  placeholder="Name" required autocomplete="off" value="<?php echo $_GET['na'] ?>"/>
                                  <?php }else{ ?>
                                  <input type="text" name="name"  placeholder="Name" required autocomplete="off"/>
                                  <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animate-input">
                                  <?php if (isset($_GET['sn'])) { ?>
                                    <input type="text" name="surname"  placeholder="Surname" required autocomplete="off" value="<?php echo $_GET['sn'] ?>"/>
                                  <?php }else{ ?>
                                <input type="text" name="surname"  placeholder="Surname" required autocomplete="off"/>
                                  <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animate-input">
                                  <?php if (isset($_GET['un'])) { ?>
                                    <input type="text" name="uname"  placeholder="Username" required="required" autocomplete="off" value="<?php echo $_GET['un'] ?>"/>
                                  <?php }else{ ?>
                                  <input type="text" name="uname"  placeholder="Username" required="required" autocomplete="off"/>
                                  <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="animate-input">
                                  <input type="password" name="pass"  placeholder="Password" required autocomplete="off"/>
                                </div>
                            </div>


                            <div class="btn-group">
                                    <input type="submit" class="btn-login" id="signin-btn" value="Register" />
                            </div>
                            </form>
                            <div class="divine">
                                <div></div>
                                <div>OR</div>
                                <div></div>
                            </div>
                            <div class="btn-group">
                                <a href="" class="btn-fb">
                                    <img src="assets/icons/facebook-icon.png" alt="">
                                    <span>Log in with Facebook</span>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a href="" class="btn-gl">
                                    <img src="assets/icons/google_search_new_logo_icon_159150.png" alt="">
                                    <span>Log in with Google</span>
                                </a>
                            </div>
                            <a href="passreset-form.php" class="forgot-pw">Forgot password?</a>
                        </div>
                    </div>
                    <div class="box goto">
                        <p>
                            Have an account?
                            <a href="login-form.php">Log in</a>
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
