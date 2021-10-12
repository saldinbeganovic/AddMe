
<?php include 'main_php/header.php'; ?>


<?php
      if (isset($_GET['p'])) {
        $uname=$_GET['p'];
      }else {
        $uname=$user['username'];
      }

      $user_profile=get_userProfile($uname);
      $uid=$user_profile['id'];
 ?>

    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <header>
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

    	<div class="container">

    		<div class="profile">

    			<div class="profile-image">

    				<img id="cover" src=" <?php if (isset($user_profile['slika_profila'])) {	echo  $user_profile['slika_profila'] ;  } else {echo "assets/default-user.png";} ?>  " alt="">

    			</div>

    			<div class="profile-user-settings">



            <?php
            if(isset($user_profile['username'])){
              ?>
              <h1 class="profile-user-name float" id="text-dark"><?php echo $user_profile['username']; ?></h1>
    			 <?php } ?>
           <?php if ($uid==$user['id']) {
             ?><a href="edit-profile.php"  class="btn profile-edit-btn float margin">Edit Profile</a><?php
           } else{
             ?>
             <a href="messages.php"  class="btn profile-edit-btn float margin">Message</a>
             <?php if (isFollowing($uname)){
                    ?>
                    <form class="float margin" id="max" action="functions/function.php" method="post">
                      <input type="hidden" name="following_id" value="<?php echo $uid; ?>">
                      <input type="hidden" name="profil" value="<?php echo $uname; ?>">
                      <button class="btn profile-edit-btn" type="submit" name="unfollow">Unfollow</button>
                    </form>
                    <?php
                  }else {
                    ?>
                    <form class="float margin" id="max" action="functions/function.php" method="post">
                      <input type="hidden" name="following_id" value="<?php echo $uid; ?>">
                      <input type="hidden" name="profil" value="<?php echo $uname; ?>">
                      <button class="btn profile-edit-btn" type="submit" name="follow">Follow</button>
                    </form>
                    <?php
                  }
           }?>




    			</div>
          <?php
          if (isset($_GET['followedby'])) {
           include 'functions/database.php';
          echo '<div id="post-menu-bg-like'.$x.'" class="post-menu-bg-like">
          <div id="post-menu-like'.$x.'" class="post-menu-like scale-in-center">';
          $query = "SELECT * FROM foloverji f INNER JOIN uporabniki u ON folover_uid=u.id WHERE foloving_uid=?";
          $stmt = $pdo->prepare($query);
          $stmt->execute([$user_profile['id']]);

          while ($likedby=$stmt->fetch()) {
            echo '<div id="postmenulike" class="post-menu_button"><div class="post__profile">';

            echo '<a href="profile.php?p='.$likedby['username'].'"  class="post__avatar">';
            echo '<img id="slika" src="'.$likedby['slika_profila'].'" alt="User Picture"></a>';
            echo $likedby['username'];
            echo  '</div>';
            echo  '</div>';
          }
      echo '<div class="post-menu_button"><a href="index.php#'.$_GET['aid'].'"  class="blabla"  name="close">CLOSE</a>
          </div></div>
          </div>';
            }
           ?>
           <?php
           if (isset($_GET['following'])) {
             include 'functions/database.php';
           echo '<div id="post-menu-bg-like'.$x.'" class="post-menu-bg-like">
           <div id="post-menu-like'.$x.'" class="post-menu-like scale-in-center">';
           $query = "SELECT * FROM foloverji f INNER JOIN uporabniki u ON foloving_uid=u.id WHERE folover_uid=?";
           $stmt = $pdo->prepare($query);
           $stmt->execute([$user_profile['id']]);

           while ($likedby=$stmt->fetch()) {
             echo '<div id="postmenulike" class="post-menu_button"><div class="post__profile">';

             echo '<a href="profile.php?p='.$likedby['username'].'"  class="post__avatar">';
             echo '<img id="slika" src="'.$likedby['slika_profila'].'" alt="User Picture"></a>';
             echo $likedby['username'];
             echo  '</div>';
             echo  '</div>';
           }
       echo '<div class="post-menu_button"><a href="index.php"  class="blabla"  name="close">CLOSE</a>
           </div></div>
           </div>';
             }
            ?>
    			<div class="profile-stats">
            <?php
            $posts=posts($uid);
            $followers=followers($uid);
            $following=following($uid);
            ?>
    				<ul>
    					<li> <a href="#" id="text-dark"><span class="profile-stat-count" id="text-dark"><?php echo $posts; ?></span> posts</a> </li>
    					<li><a href="profile.php?followedby" id="text-dark"><span class="profile-stat-count" id="text-dark"><?php echo $followers ?></span> followers</a> </li>
    					<li><a href="profile.php?following" id="text-dark"><span class="profile-stat-count" id="text-dark"><?php echo $following ?></span> following</a> </li>
    				</ul>

    			</div>

    			<div class="profile-bio">
            <?php
            if(isset($user_profile['username'])){
              ?>
            <span class="profile-real-name" id="text-dark"><?php echo $user_profile['ime'];echo " ";echo $user_profile['priimek']; ?></span><?php } ?>
    				<p ><?php  echo $user_profile['opis_profila'];?></p>

    			</div>

    		</div>
    		<!-- End of profile section -->

    	</div>
    	<!-- End of container -->

    </header>

    <main>

    	<div class="container">

    		<div class="gallery">

    			<?php gallery($uid); ?>


    		</div>
    		<!-- End of gallery -->

    	<!--	<div class="loader"></div>-->

    	</div>
    	<!-- End of container -->

    </main>
<?php include 'main_php/footer.php'; ?>
