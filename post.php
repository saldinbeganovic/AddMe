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

<?php $friends=noFriends(); ?>

    <main class="main-container">
        <section class="content-container">
            <div class="content">
                <div class="posts">
                  <?php if(isset($_GET)){
                    loadPostNew($_GET['post']);
                  } ?>
                  <?php ?>



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
                        <span><?php if(isset($_SESSION['ime'])){ echo $_SESSION['ime'];}echo " ";if(isset($_SESSION['priimek'])){echo $_SESSION['priimek'];} ?></span>
                        <?php
                      }
                        else{
                          ?>
                          <a href="#" target="_blank">Log in</a>
                          <?php
                        }
                       ?>


                    </div>
                    <a href="functions/logout.php" class="side-menu__user-button">Log Out</a>
                </div><?php


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
