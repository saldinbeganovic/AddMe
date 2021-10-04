<?php
include('main_php/header.php');



?>
<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="css/loader.css">

<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
></script>
<div class="post-menu-bg hidden-menu">
<div class="post-menu scale-in-center">
<button type="button" class="post-menu_button red" name="button">UNFOLLOW</button>
<button type="button" class="post-menu_button red" name="button">DELETE</button>
<button type="button" class="post-menu_button" name="button">GO TO POST</button>
<button type="button" class="post-menu_button " onclick="closeDiv()" name="close">CANCEL</button>
</div>
</div>

<script>
function closeDiv() {
  document.getElementById("post-menu-bg").classList.add("hidden-menu");
  document.getElementById("post-menu").classList.remove("scale-in-center");



  }
</script>

<script type="text/javascript">
window.addEventListener("menu_post", function () {
    const loader = document.querySelector(".post-menu-bg");
    loader.className += " hidden-menu"; // class "loader hidden"
});
</script>

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


    <main class="main-container">
        <section class="content-container">
            <div class="content">


                <div class="posts">
                    <?php loadPost(); ?>
                </div>
            </div>

            <section class="side-menu">
                <div class="side-menu__user-profile">
                    <a href="profile.php" class="side-menu__user-avatar">
                        <img id="slika" src="<?php if (isset($user['slika_profila'])) {	echo  $user['slika_profila'] ;  } else {echo "assets/default-user.png";} ?>" alt="User Picture">
                    </a>
                    <div class="side-menu__user-info">
                      <?php
                      if(isset($_SESSION['username'])){
                        ?>
                        <a href="profile.php" ><?php echo $_SESSION['username']; ?></a>
                        <span><?php echo $_SESSION['ime'];echo " ";echo $_SESSION['priimek']; ?></span>
                        <?php
                      }
                        else{
                          ?>
                          <a href="#" target="_blank">Log in</a>
                          <?php
                        }
                       ?>


                    </div>
                    <a href="functions/logout.php" class="side-menu__user-button">Switch</a>
                </div><?php
                $friends=noFriends();

                 if($friends==1){
                  ?>

                  <div class="side-menu__suggestions-section">
                      <div class="side-menu__suggestions-header">
                          <h2>Active Friends</h2>
                          <button>See All</button>
                      </div>
                      <div class="side-menu__suggestions-content-active">
                          <?php activeFriends(); ?>

                      </div>
                  </div>

                  <?php
                }else {
                  echo "";

                } ?>


                <div class="side-menu__suggestions-section">
                    <div class="side-menu__suggestions-header">
                        <h2>Suggestions for You</h2>
                        <button>See All</button>
                    </div>
                    <div class="side-menu__suggestions-content">
                    <?php suggestions(); ?>
                    </div>
                </div>
                <div class="side-menu__footer">
                    <div class="side-menu__footer-links">
                        <ul class="side-menu__footer-list">
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">About</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Help</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Press</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">API</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Jobs</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Privacy</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Terms</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Locations</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Top Accounts</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Hashtag</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Language</a>
                            </li>
                        </ul>
                    </div>

                    <span class="side-menu__footer-copyright">&copy; 2021 AddMe</span>
                </div>

            </section>
        </section>
    </main>


    <?php

    include('main_php/footer.php');
    ?>
