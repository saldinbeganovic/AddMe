<?php
include_once 'functions/session.php';
require 'glogin/vendor/autoload.php';
include 'functions/database.php';
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
  <link rel="stylesheet" href="css/loader.css">
  <div class="loader-wrapper">
  <div class="loader-img">
  <img id="loader-img" src="assets/icons/favico.png" alt="">
  </div>

  </div>
  <script type="text/javascript">
  window.addEventListener("load", function () {
      const loader = document.querySelector(".loader-wrapper");
      loader.className += " hidden-loader"; // class "loader hidden"
  });
  </script>
<?php

 ?>
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
                            <div class="form-group" >
                                <div class="animate-input">
                                  <?php if (isset($_GET['un'])) { ?>
                                    <input type="text" name="uname"  placeholder="Username" required="required" autocomplete="off" onkeyup="return forceLower(.this);" value="<?php echo $_GET['un'] ?>"/>
                                  <?php }else{ ?>
                                  <input type="text" name="uname"  placeholder="Username" required="required"  autocomplete="off"/>
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
                                <a href="facebook-login/login.php" class="btn-fb">
                                    <img src="assets/icons/facebook-icon.png" alt="">
                                    <span>Log in with Facebook</span>
                                </a>
                            </div>
                            <div class="btn-group">
                              <?php // Creating new google client instance
                              $client = new Google_Client();

                              // Enter your Client ID
                              $client->setClientId('1084902849777-kq73s52850eraic8hkng534c51rqujsr.apps.googleusercontent.com');
                              // Enter your Client Secrect
                              $client->setClientSecret('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');
                              // Enter the Redirect URL
                              $client->setRedirectUri('https://addme.saldinbeganovic.si/login-form.php');

                              // Adding those scopes which we want to get (email & profile Information)
                              $client->addScope("email");
                              $client->addScope("profile");


                              if(isset($_GET['code'])):

                                  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                                  if(!isset($token["error"])){

                                      $client->setAccessToken($token['access_token']);

                                      // getting profile information
                                      $google_oauth = new Google_Service_Oauth2($client);
                                      $google_account_info = $google_oauth->userinfo->get();

                                      // Storing data into database
                                      $id = /*mysqli_real_escape_string*/($google_account_info->id);
                                      $full_name = (trim($google_account_info->name));
                                      $email = ($google_account_info->email);
                                      $profile_pic = ($google_account_info->picture);

                                      // checking user already exists or not
                                      $get_user = "SELECT * FROM uporabniki WHERE google_id=?";


                                        $user = $pdo->prepare($get_user);
                                        $user->execute([$id]);
                                        $google_id = $user->fetch();

                                        $stmt = $pdo->prepare("SELECT * FROM uporabniki WHERE google_id=?");
                                        $stmt->execute([$id]);
                                        $userExists = $stmt->fetchColumn();


                                        if($userExists){
                                            //echo $id;
                                            $_SESSION['user_id'] = $google_id['id'];
                                            $_SESSION['username'] = $google_id['username'];
                                            header('Location: index.php');
                                            exit;


                                      }
                                      else{

                                          // if user not exists we will insert the user
                                        $username=preg_replace('/[ ]+/', '.', trim($full_name));
                                          $insert = 'INSERT INTO uporabniki(google_id,ime,username,email,slika_profila) VALUES (?,?,?,?,?)';
                                          $pdo->prepare($insert)->execute([$id,$full_name,$username,$email,$profile_pic]);

                                          $googleId = "SELECT * FROM uporabniki WHERE google_id=?";
                                          $google = $pdo->prepare($googleId);
                                          $google->execute([$id]);
                                          $user = $google->fetch();
                                          $_SESSION['user_id'] = $user['id'];
                                          $_SESSION['username'] = $user['username'];


                                          header('location:index.php');

                                      }

                                  }
                                  else{
                                      header('Location: login.php');
                                      exit;
                                  }

                              else:
                                  // Google Login Url = $client->createAuthUrl();
                              ?>

                                  <a href="<?php echo $client->createAuthUrl(); ?>"class="btn-gl">
                                            <img src="assets/icons/google_search_new_logo_icon_159150.png" alt="">
                                            <span>Log in with Google</span>
                                            </a>

                              <?php endif; ?>
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
