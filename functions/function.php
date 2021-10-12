<?php
if (isset($_POST['follow'])) {

    include 'database.php';
    include_once 'session.php';
    $following_id=$_POST['following_id'];
    $query = 'INSERT INTO foloverji (foloving_uid,folover_uid) VALUES (?,?)';
    $pdo->prepare($query)->execute([$following_id, $_SESSION['user_id']]);
    if(isset($_POST['profil'])){
      $p=$_POST['profil'];
       header("Location: ../profile.php?p=$p");
    }else{
       header("Location: ../index.php");
    }


}
if (isset($_POST['unfollow'])) {

    include 'database.php';
    include_once 'session.php';
    $following_id=$_POST['following_id'];
    $query = "DELETE FROM foloverji WHERE foloving_uid = ? AND folover_uid=?";
    $stmt = $pdo->prepare($query);
    $pdo->prepare($query)->execute([$following_id, $_SESSION['user_id']]);

    if(isset($_POST['profil'])){
      $p=$_POST['profil'];
       header("Location: ../profile.php?p=$p");
    }
}
if (isset($_GET['uid'])) {
  include 'database.php';
  include_once 'session.php';
  $following_id=$_GET['uid'];
  $query = "DELETE FROM foloverji WHERE foloving_uid IN (SELECT id FROM uporabniki WHERE username=?) AND folover_uid=?";
  $stmt = $pdo->prepare($query);
  $pdo->prepare($query)->execute([$following_id, $_SESSION['user_id']]);


     header("Location: ../index.php");

}
//komentar insert
if (isset($_POST['post'])) {
  include 'database.php';
  include_once 'session.php';
  date_default_timezone_set("Europe/Ljubljana");
  $dt=date('Y-m-d H:i:s');
  $komentar=$_POST['komentar'];

  $following_id=$_POST['following_id'];
  $query = 'INSERT INTO komentarji (komentar, uporabnik_id, objava_id, komenatr_date) VALUES (?,?,?,?)';
  $pdo->prepare($query)->execute([$komentar, $_POST['uporabnik_id'], $_POST['objava_id'],$dt]);
  $st=$_POST['article_id'];

    header("Location: ../index.php#$st");


}

function isAdmin($uid){
  include 'database.php';
  include_once 'session.php';
  $query = "SELECT * FROM uporabniki WHERE admin=1 AND id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid]);
  if ($stmt->rowCount() > 0 ) {
      return   true;
  } else {
      return  false;
  }
}

function countUsers(){
  include 'database.php';
  $query = "SELECT COUNT(id) FROM uporabniki";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes['COUNT(id)'];
  } else {
    return $likes=0;
  }
}

function lastUser(){
  include 'database.php';
  $query = "SELECT username, datum_reg FROM uporabniki ORDER BY id DESC LIMIT 1";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes;
  } else {
    return $likes="";
  }
}

function allUsers(){
  include 'database.php';
  $query = "SELECT * FROM uporabniki";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  while ($row = $stmt->fetch()) {
    ?>
    <tr>
      <td>
        <?php echo $row['id']; ?>
      </td>
      <td>
        <?php  echo $row['ime']; ?>
      </td>
      <td>
        <?php echo $row['priimek']; ?>
      </td>
      <td>
        <?php echo $row['username']; ?>
      </td>
      <form action="tables.php" method="get">
      <td>
      <select class="form-control category-select" name="role" id="exampleFormControlSelect1">
        <option value="0" <?php if($row['admin']==0){echo "selected";}else {
          echo "";
        } ?>>User</option>
        <option value="1" <?php if($row['admin']==1){echo "selected";}else {
          echo "";
        } ?>>Admin</option>
   </select>
     </td>
     <td>
       <?php echo $row['datum_reg']; ?>
     </td>
     <td id="levo">
       <a href="tables.php?deleteu=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
       <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
       <input type="submit" name="update" class="btn btn-primary" value="SAVE">
  </td>
  </form>

    </tr>

<?php
    }
}

function allPost(){
  include 'database.php';
  $query = "SELECT *,o.id as oid,o.ime as oime FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id ";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  while ($row = $stmt->fetch()) {
    ?>
    <tr>
      <td>
        <?php echo $row['oid']; ?>
      </td>
      <td>
        <?php  echo $row['oime']; ?>
      </td>
      <td>
        <?php echo $row['opis']; ?>
      </td>
      <td>
         <?php echo $row['username']; ?>
      </td>
      <td>
        <?php echo $row['datum_objave']; ?>
     </td>
     <td id="levo">
       <a href="tables.php?deletep=<?php echo $row['oid']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>

  </td>


    </tr>

<?php
    }
}


function lastUsers(){
  include 'database.php';
  $query = "SELECT * FROM uporabniki ORDER BY id DESC LIMIT 5";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $x=1;
  while ($row = $stmt->fetch()) {

    $posts=posts($row['id']);
    $followers=followers($row['id']);
    ?>
    <tr>
      <td>
        <?php echo $x; ?>
      </td>
      <td>
        <?php  echo $row['ime']; ?>
      </td>
      <td>
        <?php echo $row['priimek']; ?>
      </td>
      <td>
        <?php echo $row['username']; ?>
      </td>
      <td class="text-primary">
        <?php echo $posts; ?>
      </td>
      <td class="text-primary">
        <?php echo $followers; ?>
      </td>
      <td>
        <?php echo $row['datum_reg'];; ?>
      </td>
    </tr>

    <?php $x=$x+1;

    }
}


function countPost(){
  include 'database.php';
  $query = "SELECT COUNT(id) FROM objave";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes['COUNT(id)'];
  } else {
    return $likes=0;
  }
}

function userUpdated(){
  include 'database.php';
  $query = "SELECT * FROM uporabniki ORDER BY id DESC LIMIT 1";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes['datum_reg'];
  } else {
    return $likes=0;
  }
}

function postUpdated(){
  include 'database.php';
  $query = "SELECT * FROM objave ORDER BY id DESC LIMIT 1";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes['datum_objave'];
  } else {
    return $likes=0;
  }
}


function time_elapsed_user($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',

    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function myPost($objava_id)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT * FROM objave WHERE uporabnik_id=? AND id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id'],$objava_id]);

  if ($stmt->rowCount() > 0 ) {
      return   true;
  } else {
      return  false;
  }
}

function liked($objava_id)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT COUNT(id) FROM lajki WHERE objava_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);

  if ($stmt->rowCount() > 0 ) {
      $likes = $stmt->fetch();
      return $likes['COUNT(id)'];
  } else {
    return $likes=0;
  }
}

function commentCount($objava_id)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT COUNT(id) FROM komentarji WHERE objava_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);

  if ($stmt->rowCount() > 0 ) {
      $count = $stmt->fetch();
      return $count['COUNT(id)'];
  } else {
    return $count=0;
  }
}

function likedByMe($objava_id)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT * FROM lajki WHERE uporabnik_id=? AND objava_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id'],$objava_id]);

  if ($stmt->rowCount() > 0 ) {
      return   true;
  } else {
      return  false;
  }
}

function randomLikeImg($objava_id)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT * FROM lajki l INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ORDER BY RAND() LIMIT 1 ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);

  if ($stmt->rowCount() > 0 ) {
    $slika = $stmt->fetch();
    return $slika;
  }
}



function posts($uid)
{
  include 'database.php';

  $query = "SELECT COUNT(id) FROM objave WHERE uporabnik_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid]);
  if ($stmt->rowCount() > 0) {
    $post = $stmt->fetch();
    return $post['COUNT(id)'];
  }else{
    return 0;
  }

}

function amFollowing($uid)
{
  include 'database.php';
  include_once 'session.php';
  $query = "SELECT * FROM foloverji WHERE (foloving_uid IN (SELECT id FROM uporabniki WHERE username=?) AND folover_uid=?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid,$_SESSION['user_id']]);
  if ($stmt->rowCount() > 0) {
    return true;
  }else{
    return false;
  }
}

function followers($uid)
{
  include 'database.php';

  $query = "SELECT COUNT(id) FROM foloverji WHERE foloving_uid=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid]);
  if ($stmt->rowCount() > 0) {
    $post = $stmt->fetch();
    return $post['COUNT(id)'];
  }else{
    return 0;
  }
}

function following($uid)
{
  include 'database.php';
  include_once 'session.php';
  $query = "SELECT COUNT(id) FROM foloverji WHERE folover_uid=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid]);
  if ($stmt->rowCount() > 0) {
    $post = $stmt->fetch();
    return $post['COUNT(id)'];
  }else{
    return 0;
  }
}

function isFollowing($uname){
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT * FROM foloverji WHERE folover_uid=?  AND foloving_uid IN (SELECT id FROM uporabniki WHERE username=?) ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id'],$uname]);

  if ($stmt->rowCount() > 0 ) {
      return   true;
  } else {
      return  false;
  }
}



function noFriends(){
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT * FROM foloverji WHERE folover_uid =?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id']]);

  if ($stmt->rowCount() > 0 ) {
      $_SESSION['limit']=3;
      return   $friends=1;
  } else {
      $_SESSION['limit']=5;
      return  $friends=0;
  }
}



function get_user()
{
        include 'database.php';
        include_once 'session.php';

        $query = "SELECT * FROM uporabniki WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['user_id']]);

        if ($stmt->rowCount() > 0 ) {
            return  $stmt->fetch();
        } else {
            return "User not found.";
        }

}

function get_userProfile($uname)
{
        include 'database.php';
        include_once 'session.php';

        $query = "SELECT * FROM uporabniki WHERE username=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$uname]);

        if ($stmt->rowCount() > 0 ) {
            return  $stmt->fetch();
        } else {
            return "User not found.";
        }

}

function getCommentsPostLong($objava_id){
  include 'database.php';
  include_once 'session.php';


  $query = "SELECT * FROM komentarji k INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);




  while ($row = $stmt->fetch()) {

    #if(isFollowing($row['username']))
    #{
    $cas=time_elapsed_comment($row['komenatr_date'], false);
    echo '<div class="post__description" style="justify-content: space-between;"><span>';
    echo '<a class="post__name--underline" href="profile.php?p='.$row['username'].'" >'.$row['username'].'</a> '.$row['komentar'].'';
    echo '</span>
    <span id="small">'.$cas.'</span>
    </div>'
    ;
    #}

    }

}

function getCommentsPost($objava_id){
  include 'database.php';
  include_once 'session.php';


  $query = "SELECT * FROM komentarji k INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ORDER BY RAND() LIMIT 2";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);




  while ($row = $stmt->fetch()) {

    #if(isFollowing($row['username']))
    #{
    $cas=time_elapsed_comment($row['komenatr_date'], false);
    echo '<div class="post__description" style="justify-content: space-between;"><span>';
    echo '<a class="post__name--underline" href="profile.php?p='.$row['username'].'" >'.$row['username'].'</a> '.$row['komentar'].'';
    echo '</span>
    <span id="small">'.$cas.'</span>
    </div>'
    ;
    #}

    }

}

function suggestions()
{
        include 'database.php';
        include_once 'session.php';
        $uporabnik=$_SESSION['user_id'];
        $query = "SELECT * FROM uporabniki WHERE id NOT IN (SELECT foloving_uid FROM foloverji WHERE folover_uid='$uporabnik') AND id!=? ORDER BY RAND() DESC LIMIT ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['user_id'],$_SESSION['limit']]);

        if ($stmt->rowCount() > 0 ) {

        while ($row = $stmt->fetch()) {


          if(followers($row['id'])>0){
            $followers=followers($row['id']);
            $string="Followed by $followers others";
          }else{
            $string="New to instagram.";
          }


            echo '<div class="side-menu__suggestions-content">';
            echo '<form  action="functions/function.php" method="post">';
            echo '<div class="side-menu__suggestion">';
            echo '<a href="profile.php?p='.$row['username'].'" class="side-menu__suggestion-avatar">';
            echo '<img id="slika" src="'.$row['slika_profila'].'" alt="User Picture"></a>';
            echo '<div class="side-menu__suggestion-info">';
            echo '<a href="profile.php?p='.$row['username'].'">'.$row['username'].'</a>';
            echo '<span>'.$string.'</span>';
            echo '</div>';
            echo '<input type="hidden" name="following_id" value="'.$row['id'].'">';
            echo '<input type="submit" class="side-menu__suggestion-button" name="follow" value="Follow" />';
            echo '</div>';
            echo '</form>';

            $_SESSION['limit_s']=4;
        }

      }else{
        echo "";
        $_SESSION['limit_s']=8;
      }


}

function activeFriends()
{

        include 'database.php';
        include_once 'session.php';
        $uporabnik=$_SESSION['user_id'];
        $query = "SELECT * FROM uporabniki WHERE id IN (SELECT foloving_uid FROM foloverji WHERE folover_uid='$uporabnik') AND active=1 LIMIT ".$_SESSION['limit_s']." ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0 ) {
        while ($row = $stmt->fetch()) {
            $followers=followers($row['id']);
            echo '<div class="side-menu__suggestion">';
            echo '<a href="profile.php?p='.$row['username'].'" class="side-menu__suggestion-avatar">';
            echo '<img id="slika" src="'.$row['slika_profila'].'" alt="User Picture"></a>';
            echo '<div class="side-menu__suggestion-info">';
            echo '<a href="profile.php?p='.$row['username'].'">'.$row['username'].' <img id="active" src="assets/icons/active.png" alt="active_image"></a>';
            echo '<span >'.$followers.' followers'.'</span>';
            echo '</div>';
            echo '<button class="side-menu__suggestion-button">Chat</button>';
            echo '</div>';
        }}else {
          echo '<div class="side-menu__suggestion">';
          echo '<div id="middle-span" class="side-menu__suggestion-info">';
          echo '<span >No active friends.</span>';
          echo '</div>';
          echo '</div>';
        }

}

function loadPost()
{
  include 'database.php';
  include_once 'session.php';


  $query = "SELECT *,o.id AS oid FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id  ORDER BY datum_objave DESC ";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $x=0;


  while ($row = $stmt->fetch()) {
      if (amFollowing($row['username']) or myPost($row['oid'])) {
      $x=$x+1;
      echo '<article class="post" id="'.$x.'">
          <div class="post__header">
              <div class="post__profile">';
      echo '<a href="profile.php?p='.$row['username'].'"  class="post__avatar">';
      echo '<img id="slika" src="'.$row['slika_profila'].'" alt="User Picture"></a>';
      echo '<a href="profile.php?p='.$row['username'].'" class="post__user">'.$row['username'].' </a>';
      echo '</div>';
//skripta za class more options
      $oid=$row['oid'];
      echo
      '<script>
      function showDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.remove("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.add("scale-in-center");
        }

      </script>';


//button more options
      echo '<button onclick="showDiv'.$x.'()" id="'.$row['oid'].'" class="post__more-options">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="12" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="17.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
          </svg>
      </button>';
//options menu
      echo '<div id="post-menu-bg'.$x.'" class="post-menu-bg hidden-menu">
      <div id="post-menu'.$x.'" class="post-menu scale-in-center">
      <button type="button" onclick="unfollow'.$x.'()" class="post-menu_button red" name="button"'; if($_SESSION['username']==$row['username']){echo "disabled";}else {echo "";} echo'>UNFOLLOW</button>
      <button type="button" id="'.$row['oid'].'" onclick="deletePost'.$x.'()" class="post-menu_button red" name="button" '; if(!myPost($row['oid'])){echo "disabled";}else {echo "";} echo' >DELETE</button>
      <button type="button" class="post-menu_button" name="button">GO TO POST</button>
      <button type="button" class="post-menu_button " onclick="closeDiv'.$x.'()" name="close">CANCEL</button>
      </div>
      </div>';

//like menu
      if (isset($_GET['likedby'])) {
      echo '<div id="post-menu-bg-like'.$x.'" class="post-menu-bg-like">
      <div id="post-menu-like'.$x.'" class="post-menu-like scale-in-center">';
      $query = "SELECT * FROM lajki l INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ORDER BY RAND()";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_GET['likedby']]);

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
//srkipte
      echo '<script>
      function unfollow'.$x.'(){
        location.href = "functions/function.php?uid='.$row['username'].'";
      }
      function deletePost'.$x.'(){
        location.href = "functions/delete.php?oid='.$row['oid'].'";
      }
      function closeDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.add("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.remove("scale-in-center");
        }
        function closeDivLike'.$x.'() {

          document.getElementById("post-menu-bg-like'.$x.'").classList.add("hidden-menu");
          document.getElementById("post-menu-like'.$x.'").classList.remove("scale-in-center");
          }
      </script>';
//ostali del posta
      echo '</div>';

      echo '<div class="post__content">
          <div class="post__medias">';
      echo '<img class="post__media" src="'.$row['path'].'" alt="Post Content">';
      echo '</div>';
      echo '</div>';

      echo '<script>$(document).ready(function(){
        $(".unlike").click(function(){
          $(this).toggleClass("like");
        });
      })</script>
      <script type="text/javascript">
      function submitForm()
      {
        document.getElementById("submit").submit();
      }
      </script>
      ';

      echo '  <div class="post__footer">
            <div class="post__buttons">
            <form action="functions/like.php" method="post">
                <button id="submit" class="post__button animate__animated animate__pulse">
                    <svg '; if(likedByMe($row['oid'])){echo 'class="unlike like"';} else {echo 'class="unlike"';}echo' width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="fill" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.6"/>
                    </svg>
                </button>
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                </form>
                <script>
                function loadPost'.$x.'(){
                  location.href = "post.php?post='.$row['oid'].'";
                }</script>
                <button onclick="loadPost'.$x.'()" class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2959 20.8165L20.2351 16.8602C20.1743 16.6385 20.2047 16.3994 20.309 16.1907C21.2351 14.3342 21.5438 12.117 20.9742 9.80402C20.2003 6.67374 17.757 4.16081 14.6354 3.33042C13.7833 3.10869 12.9442 3 12.1312 3C6.29665 3 1.74035 8.47365 3.31418 14.5647C4.04458 17.3819 7.05314 20.2992 9.88344 20.9861C10.6486 21.173 11.4008 21.26 12.1312 21.26C13.7006 21.26 15.1701 20.8557 16.4614 20.1601C16.6049 20.0818 16.7657 20.0383 16.9222 20.0383C17.0005 20.0383 17.0787 20.047 17.157 20.0688L21.009 21.0991C21.0307 21.1035 21.0525 21.1078 21.0699 21.1078C21.2177 21.1078 21.3351 20.9687 21.2959 20.8165ZM19.0178 17.1863L19.6178 19.4253L17.4831 18.8558C17.3005 18.8079 17.1135 18.7819 16.9222 18.7819C16.557 18.7819 16.1875 18.8775 15.8571 19.0558C14.6963 19.6818 13.4441 19.9992 12.1312 19.9992C11.4834 19.9992 10.8269 19.9166 10.1791 19.7601C7.78354 19.1775 5.14453 16.6037 4.53586 14.2473C3.90111 11.7865 4.40109 9.26057 5.90536 7.31719C7.40964 5.3738 9.6791 4.26081 12.1312 4.26081C12.8529 4.26081 13.5876 4.35646 14.3137 4.5521C16.9961 5.26511 19.0786 7.39544 19.7525 10.1084C20.2264 12.0213 20.0308 13.9299 19.183 15.6298C18.9395 16.1168 18.8787 16.6689 19.0178 17.1863Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
                <button class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.8555 3.44542C22.6978 3.16703 22.3962 3 22.0714 3L2.91369 3.01392C2.52859 3.01392 2.19453 3.25055 2.05997 3.60781C1.96254 3.86764 1.98574 4.14603 2.11565 4.37338C2.16669 4.45689 2.23165 4.53577 2.31052 4.60537L9.69243 10.9712L11.4927 20.5338C11.5623 20.9096 11.8499 21.188 12.2304 21.2483C12.6062 21.3086 12.9774 21.1323 13.1723 20.8029L22.8509 4.35018C23.0179 4.06715 23.0179 3.72381 22.8555 3.44542ZM4.21748 4.39194H19.8164L10.4255 9.75089L4.21748 4.39194ZM12.6248 18.9841L11.1122 10.948L20.5171 5.58436L12.6248 18.9841Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.3"/>
                    </svg>
                </button>

                <div class="post__indicators"></div>

                <button class="post__button post__button--align-right">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.875 2H4.125C3.50625 2 3 2.44939 3 3.00481V22.4648C3 23.0202 3.36563 23.1616 3.82125 22.7728L11.5444 16.1986C11.7244 16.0471 12.0225 16.0471 12.2025 16.1936L20.1731 22.7879C20.6287 23.1666 21 23.0202 21 22.4648V3.00481C21 2.44939 20.4994 2 19.875 2ZM19.3125 20.0209L13.3444 15.0827C12.9281 14.7394 12.405 14.5677 11.8763 14.5677C11.3363 14.5677 10.8019 14.7444 10.3856 15.0979L4.6875 19.9502V3.51479H19.3125V20.0209Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
            </div>';


            $likes=liked($row['oid']);
            $randomLikeImg=randomLikeImg($row['oid']);
        echo '<div class="post__infos">
            <div class="post__likes">';

            if ($likes>0) {
              echo ' <a href="profile.php?p='.$randomLikeImg['username'].'" class="post__likes-avatar">
                    <img id="slika" src="'.$randomLikeImg['slika_profila'].'" alt="User Picture">
                    </a>';
            }else {
              echo '';
            }


                $cas=time_elapsed_string($row['datum_objave'], false);

                if ($likes==1) {
                  echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> </span>';
                }else if($likes==0) {
                  echo ' <span>No likes yet</span>';
                }else{
                  $likes=$likes-1;
                  if ($likes==1) {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline">'.$likes.' other</a></span>';
                  }else {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline" onclick="showDivLike'.$x.'()">'.$likes.' others</a></span>';
                  }

                }


            echo '     </div>

                <div class="post__description">
                    <span>';

                    if (!empty($row['opis'])) {
                      echo '<a class="post__name--underline" href="profile.php?p='.$row['username'].'" >'.$row['username'].'</a> '.$row['opis'].'';
                    }else {
                      echo "";
                    }



              echo '     </span>
                </div>';

                if (null !==(getCommentsPost($row['oid']))) {

                  echo getCommentsPost();

                }else {
                  echo "";
                }



                echo '<span class="post__date-time">'.$cas.'</span>
                <form  action="functions/function.php" method="post">
                <div class="comment_box">

                <textarea style="height: 18px !important;" id="textarea'.$x.'" class="form-control" name="komentar" placeholder="Add a comment..."></textarea>
                <input type="submit" class="comment_box_button side-menu__suggestion-button" name="post" value="Post" />
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                <script
                src="https://code.jquery.com/jquery-3.6.0.min.js"
                ></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js">
                </script>
                <script>

                  $(document).ready(function(){
                    $("#textarea'.$x.'").emojioneArea({
                      pickerPosition:"top"
                    });
                  });

                </script>
                </div>
                </form>
            </div>
        </div>
    </article>';
}
}}

function loadPostNew($objava_id)
{
  include 'database.php';
  include_once 'session.php';


  $query = "SELECT *,o.id AS oid FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE o.id=? ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$objava_id]);
  $x=0;


  while ($row = $stmt->fetch()) {
      if (amFollowing($row['username']) or myPost($row['oid'])) {
      $x=$x+1;
      echo '<article class="post" id="'.$x.'">
          <div class="post__header">
              <div class="post__profile">';
      echo '<a href="profile.php?p='.$row['username'].'"  class="post__avatar">';
      echo '<img id="slika" src="'.$row['slika_profila'].'" alt="User Picture"></a>';
      echo '<a href="profile.php?p='.$row['username'].'" class="post__user">'.$row['username'].' </a>';
      echo '</div>';
//skripta za class more options
      $oid=$row['oid'];
      echo
      '<script>
      function showDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.remove("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.add("scale-in-center");
        }

      </script>';


//button more options
      echo '<button onclick="showDiv'.$x.'()" id="'.$row['oid'].'" class="post__more-options">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="12" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="17.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
          </svg>
      </button>';
//options menu
      echo '<div id="post-menu-bg'.$x.'" class="post-menu-bg hidden-menu">
      <div id="post-menu'.$x.'" class="post-menu scale-in-center">
      <button type="button" onclick="unfollow'.$x.'()" class="post-menu_button red" name="button"'; if($_SESSION['username']==$row['username']){echo "disabled";}else {echo "";} echo'>UNFOLLOW</button>
      <button type="button" id="'.$row['oid'].'" onclick="deletePost'.$x.'()" class="post-menu_button red" name="button" '; if(!myPost($row['oid'])){echo "disabled";}else {echo "";} echo' >DELETE</button>
      <button type="button" class="post-menu_button" name="button">GO TO POST</button>
      <button type="button" class="post-menu_button " onclick="closeDiv'.$x.'()" name="close">CANCEL</button>
      </div>
      </div>';

//like menu
      if (isset($_GET['likedby'])) {
      echo '<div id="post-menu-bg-like'.$x.'" class="post-menu-bg-like">
      <div id="post-menu-like'.$x.'" class="post-menu-like scale-in-center">';
      $query = "SELECT * FROM lajki l INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ORDER BY RAND()";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_GET['likedby']]);

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
//srkipte
      echo '<script>
      function unfollow'.$x.'(){
        location.href = "functions/function.php?uid='.$row['username'].'";
      }
      function deletePost'.$x.'(){
        location.href = "functions/delete.php?oid='.$row['oid'].'";
      }
      function closeDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.add("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.remove("scale-in-center");
        }
        function closeDivLike'.$x.'() {

          document.getElementById("post-menu-bg-like'.$x.'").classList.add("hidden-menu");
          document.getElementById("post-menu-like'.$x.'").classList.remove("scale-in-center");
          }
      </script>';
//ostali del posta
      echo '</div>';

      echo '<div class="post__content">
          <div class="post__medias">';
      echo '<img class="post__media" src="'.$row['path'].'" alt="Post Content">';
      echo '</div>';
      echo '</div>';

      echo '<script>$(document).ready(function(){
        $(".unlike").click(function(){
          $(this).toggleClass("like");
        });
      })</script>
      <script type="text/javascript">
      function submitForm()
      {
        document.getElementById("submit").submit();
      }
      </script>
      ';

      echo '  <div class="post__footer">
            <div class="post__buttons">
            <form action="functions/like.php" method="post">
                <button id="submit" class="post__button animate__animated animate__pulse">
                    <svg '; if(likedByMe($row['oid'])){echo 'class="unlike like"';} else {echo 'class="unlike"';}echo' width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="fill" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.6"/>
                    </svg>
                </button>
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                </form>
                <button class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2959 20.8165L20.2351 16.8602C20.1743 16.6385 20.2047 16.3994 20.309 16.1907C21.2351 14.3342 21.5438 12.117 20.9742 9.80402C20.2003 6.67374 17.757 4.16081 14.6354 3.33042C13.7833 3.10869 12.9442 3 12.1312 3C6.29665 3 1.74035 8.47365 3.31418 14.5647C4.04458 17.3819 7.05314 20.2992 9.88344 20.9861C10.6486 21.173 11.4008 21.26 12.1312 21.26C13.7006 21.26 15.1701 20.8557 16.4614 20.1601C16.6049 20.0818 16.7657 20.0383 16.9222 20.0383C17.0005 20.0383 17.0787 20.047 17.157 20.0688L21.009 21.0991C21.0307 21.1035 21.0525 21.1078 21.0699 21.1078C21.2177 21.1078 21.3351 20.9687 21.2959 20.8165ZM19.0178 17.1863L19.6178 19.4253L17.4831 18.8558C17.3005 18.8079 17.1135 18.7819 16.9222 18.7819C16.557 18.7819 16.1875 18.8775 15.8571 19.0558C14.6963 19.6818 13.4441 19.9992 12.1312 19.9992C11.4834 19.9992 10.8269 19.9166 10.1791 19.7601C7.78354 19.1775 5.14453 16.6037 4.53586 14.2473C3.90111 11.7865 4.40109 9.26057 5.90536 7.31719C7.40964 5.3738 9.6791 4.26081 12.1312 4.26081C12.8529 4.26081 13.5876 4.35646 14.3137 4.5521C16.9961 5.26511 19.0786 7.39544 19.7525 10.1084C20.2264 12.0213 20.0308 13.9299 19.183 15.6298C18.9395 16.1168 18.8787 16.6689 19.0178 17.1863Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
                <button class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.8555 3.44542C22.6978 3.16703 22.3962 3 22.0714 3L2.91369 3.01392C2.52859 3.01392 2.19453 3.25055 2.05997 3.60781C1.96254 3.86764 1.98574 4.14603 2.11565 4.37338C2.16669 4.45689 2.23165 4.53577 2.31052 4.60537L9.69243 10.9712L11.4927 20.5338C11.5623 20.9096 11.8499 21.188 12.2304 21.2483C12.6062 21.3086 12.9774 21.1323 13.1723 20.8029L22.8509 4.35018C23.0179 4.06715 23.0179 3.72381 22.8555 3.44542ZM4.21748 4.39194H19.8164L10.4255 9.75089L4.21748 4.39194ZM12.6248 18.9841L11.1122 10.948L20.5171 5.58436L12.6248 18.9841Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.3"/>
                    </svg>
                </button>

                <div class="post__indicators"></div>

                <button class="post__button post__button--align-right">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.875 2H4.125C3.50625 2 3 2.44939 3 3.00481V22.4648C3 23.0202 3.36563 23.1616 3.82125 22.7728L11.5444 16.1986C11.7244 16.0471 12.0225 16.0471 12.2025 16.1936L20.1731 22.7879C20.6287 23.1666 21 23.0202 21 22.4648V3.00481C21 2.44939 20.4994 2 19.875 2ZM19.3125 20.0209L13.3444 15.0827C12.9281 14.7394 12.405 14.5677 11.8763 14.5677C11.3363 14.5677 10.8019 14.7444 10.3856 15.0979L4.6875 19.9502V3.51479H19.3125V20.0209Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
            </div>';


            $likes=liked($row['oid']);
            $randomLikeImg=randomLikeImg($row['oid']);
        echo '<div class="post__infos">
            <div class="post__likes">';

            if ($likes>0) {
              echo ' <a href="profile.php?p='.$randomLikeImg['username'].'" class="post__likes-avatar">
                    <img id="slika" src="'.$randomLikeImg['slika_profila'].'" alt="User Picture">
                    </a>';
            }else {
              echo '';
            }


                $cas=time_elapsed_string($row['datum_objave'], false);

                if ($likes==1) {
                  echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> </span>';
                }else if($likes==0) {
                  echo ' <span>No likes yet</span>';
                }else{
                  $likes=$likes-1;
                  if ($likes==1) {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline">'.$likes.' other</a></span>';
                  }else {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline" onclick="showDivLike'.$x.'()">'.$likes.' others</a></span>';
                  }

                }


            echo '     </div>

                <div class="post__description">
                    <span>';

                    if (!empty($row['opis'])) {
                      echo '<a class="post__name--underline" href="profile.php?p='.$row['username'].'" >'.$row['username'].'</a> '.$row['opis'].'';
                    }else {
                      echo "";
                    }



              echo '     </span>
                </div>';

                if (null !==(getCommentsPostLong($row['oid']))) {

                  echo getCommentsPostLong();

                }else {
                  echo "";
                }



                echo '<span class="post__date-time">'.$cas.'</span>
                <form  action="functions/function.php" method="post">
                <div class="comment_box" id="com">

                <textarea style="height: 18px !important;" id="textarea'.$x.'" class="form-control" name="komentar" placeholder="Add a comment..."></textarea>
                <input type="submit" class="comment_box_button side-menu__suggestion-button" name="post" value="Post" />
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                <script
                src="https://code.jquery.com/jquery-3.6.0.min.js"
                ></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js">
                </script>
                <script>

                  $(document).ready(function(){
                    $("#textarea'.$x.'").emojioneArea({
                      pickerPosition:"top"
                    });
                  });

                </script>
                </div>
                </form>
            </div>
        </div>
    </article>';
}
}}


function loadPostSuggestions()
{
  include 'database.php';
  include_once 'session.php';


  $query = "SELECT *,o.id AS oid FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id  ORDER BY RAND() ";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $x=0;


  while ($row = $stmt->fetch()) {

      $x=$x+1;
      echo '<article class="post" id="'.$x.'">
          <div class="post__header">
              <div class="post__profile">';
      echo '<a href="profile.php?p='.$row['username'].'"  class="post__avatar">';
      echo '<img id="slika" src="'.$row['slika_profila'].'" alt="User Picture"></a>';
      echo '<a href="profile.php?p='.$row['username'].'" class="post__user">'.$row['username'].' </a>';
      echo '</div>';
//skripta za class more options
      $oid=$row['oid'];
      echo
      '<script>
      function showDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.remove("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.add("scale-in-center");
        }

      </script>';


//button more options
      echo '<button onclick="showDiv'.$x.'()" id="'.$row['oid'].'" class="post__more-options">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="12" cy="11.5" r="1.5" fill="var(--text-dark)"/>
              <circle cx="17.5" cy="11.5" r="1.5" fill="var(--text-dark)"/>
          </svg>
      </button>';
//options menu
      echo '<div id="post-menu-bg'.$x.'" class="post-menu-bg hidden-menu">
      <div id="post-menu'.$x.'" class="post-menu scale-in-center">
      <button type="button" onclick="unfollow'.$x.'()" class="post-menu_button red" name="button"'; if($_SESSION['username']==$row['username']){echo "disabled";}else {echo "";} echo'>UNFOLLOW</button>
      <button type="button" id="'.$row['oid'].'" onclick="deletePost'.$x.'()" class="post-menu_button red" name="button" '; if(!myPost($row['oid'])){echo "disabled";}else {echo "";} echo' >DELETE</button>
      <button type="button" class="post-menu_button" name="button">GO TO POST</button>
      <button type="button" class="post-menu_button " onclick="closeDiv'.$x.'()" name="close">CANCEL</button>
      </div>
      </div>';

//like menu
      if (isset($_GET['likedby'])) {
      echo '<div id="post-menu-bg-like'.$x.'" class="post-menu-bg-like">
      <div id="post-menu-like'.$x.'" class="post-menu-like scale-in-center">';
      $query = "SELECT * FROM lajki l INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE objava_id=? ORDER BY RAND()";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_GET['likedby']]);

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
//srkipte
      echo '<script>
      function unfollow'.$x.'(){
        location.href = "functions/function.php?uid='.$row['username'].'";
      }
      function deletePost'.$x.'(){
        location.href = "functions/delete.php?oid='.$row['oid'].'";
      }
      function closeDiv'.$x.'() {

        document.getElementById("post-menu-bg'.$x.'").classList.add("hidden-menu");
        document.getElementById("post-menu'.$x.'").classList.remove("scale-in-center");
        }
        function closeDivLike'.$x.'() {

          document.getElementById("post-menu-bg-like'.$x.'").classList.add("hidden-menu");
          document.getElementById("post-menu-like'.$x.'").classList.remove("scale-in-center");
          }
      </script>';
//ostali del posta
      echo '</div>';

      echo '<div class="post__content">
          <div class="post__medias">';
      echo '<img class="post__media" src="'.$row['path'].'" alt="Post Content">';
      echo '</div>';
      echo '</div>';

      echo '<script>$(document).ready(function(){
        $(".unlike").click(function(){
          $(this).toggleClass("like");
        });
      })</script>
      <script type="text/javascript">
      function submitForm()
      {
        document.getElementById("submit").submit();
      }
      </script>
      ';

      echo '  <div class="post__footer">
            <div class="post__buttons">
            <form action="functions/like.php" method="post">
                <button id="submit" class="post__button animate__animated animate__pulse">
                    <svg '; if(likedByMe($row['oid'])){echo 'class="unlike like"';} else {echo 'class="unlike"';}echo' width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="fill" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.6"/>
                    </svg>
                </button>
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                </form>
                <script>
                function loadPost'.$x.'(){
                  location.href = "post.php?post='.$row['oid'].'";
                }</script>
                <button onclick="loadPost'.$x.'()" class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2959 20.8165L20.2351 16.8602C20.1743 16.6385 20.2047 16.3994 20.309 16.1907C21.2351 14.3342 21.5438 12.117 20.9742 9.80402C20.2003 6.67374 17.757 4.16081 14.6354 3.33042C13.7833 3.10869 12.9442 3 12.1312 3C6.29665 3 1.74035 8.47365 3.31418 14.5647C4.04458 17.3819 7.05314 20.2992 9.88344 20.9861C10.6486 21.173 11.4008 21.26 12.1312 21.26C13.7006 21.26 15.1701 20.8557 16.4614 20.1601C16.6049 20.0818 16.7657 20.0383 16.9222 20.0383C17.0005 20.0383 17.0787 20.047 17.157 20.0688L21.009 21.0991C21.0307 21.1035 21.0525 21.1078 21.0699 21.1078C21.2177 21.1078 21.3351 20.9687 21.2959 20.8165ZM19.0178 17.1863L19.6178 19.4253L17.4831 18.8558C17.3005 18.8079 17.1135 18.7819 16.9222 18.7819C16.557 18.7819 16.1875 18.8775 15.8571 19.0558C14.6963 19.6818 13.4441 19.9992 12.1312 19.9992C11.4834 19.9992 10.8269 19.9166 10.1791 19.7601C7.78354 19.1775 5.14453 16.6037 4.53586 14.2473C3.90111 11.7865 4.40109 9.26057 5.90536 7.31719C7.40964 5.3738 9.6791 4.26081 12.1312 4.26081C12.8529 4.26081 13.5876 4.35646 14.3137 4.5521C16.9961 5.26511 19.0786 7.39544 19.7525 10.1084C20.2264 12.0213 20.0308 13.9299 19.183 15.6298C18.9395 16.1168 18.8787 16.6689 19.0178 17.1863Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
                <button class="post__button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.8555 3.44542C22.6978 3.16703 22.3962 3 22.0714 3L2.91369 3.01392C2.52859 3.01392 2.19453 3.25055 2.05997 3.60781C1.96254 3.86764 1.98574 4.14603 2.11565 4.37338C2.16669 4.45689 2.23165 4.53577 2.31052 4.60537L9.69243 10.9712L11.4927 20.5338C11.5623 20.9096 11.8499 21.188 12.2304 21.2483C12.6062 21.3086 12.9774 21.1323 13.1723 20.8029L22.8509 4.35018C23.0179 4.06715 23.0179 3.72381 22.8555 3.44542ZM4.21748 4.39194H19.8164L10.4255 9.75089L4.21748 4.39194ZM12.6248 18.9841L11.1122 10.948L20.5171 5.58436L12.6248 18.9841Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.3"/>
                    </svg>
                </button>

                <div class="post__indicators"></div>

                <button class="post__button post__button--align-right">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.875 2H4.125C3.50625 2 3 2.44939 3 3.00481V22.4648C3 23.0202 3.36563 23.1616 3.82125 22.7728L11.5444 16.1986C11.7244 16.0471 12.0225 16.0471 12.2025 16.1936L20.1731 22.7879C20.6287 23.1666 21 23.0202 21 22.4648V3.00481C21 2.44939 20.4994 2 19.875 2ZM19.3125 20.0209L13.3444 15.0827C12.9281 14.7394 12.405 14.5677 11.8763 14.5677C11.3363 14.5677 10.8019 14.7444 10.3856 15.0979L4.6875 19.9502V3.51479H19.3125V20.0209Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
                    </svg>
                </button>
            </div>';


            $likes=liked($row['oid']);
            $randomLikeImg=randomLikeImg($row['oid']);
        echo '<div class="post__infos">
            <div class="post__likes">';

            if ($likes>0) {
              echo ' <a href="profile.php?p='.$randomLikeImg['username'].'" class="post__likes-avatar">
                    <img id="slika" src="'.$randomLikeImg['slika_profila'].'" alt="User Picture">
                    </a>';
            }else {
              echo '';
            }


                $cas=time_elapsed_string($row['datum_objave'], false);

                if ($likes==1) {
                  echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> </span>';
                }else if($likes==0) {
                  echo ' <span>No likes yet</span>';
                }else{
                  $likes=$likes-1;
                  if ($likes==1) {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline">'.$likes.' other</a></span>';
                  }else {
                    echo '<span>Liked by <a class="post__name--underline" href="profile.php?p='.$randomLikeImg['username'].'" >'.$randomLikeImg['username'].'</a> and <a href="index.php?likedby='.$row['oid'].'&aid='.$x.'" class="post__name--underline" onclick="showDivLike'.$x.'()">'.$likes.' others</a></span>';
                  }

                }


            echo '     </div>

                <div class="post__description">
                    <span>';

                    if (!empty($row['opis'])) {
                      echo '<a class="post__name--underline" href="profile.php?p='.$row['username'].'" >'.$row['username'].'</a> '.$row['opis'].'';
                    }else {
                      echo "";
                    }



              echo '     </span>
                </div>';

                if (null !==(getCommentsPost($row['oid']))) {

                  echo getCommentsPost();

                }else {
                  echo "";
                }



                echo '<span class="post__date-time">'.$cas.'</span>
                <form  action="functions/function.php" method="post">
                <div class="comment_box">

                <textarea style="height: 18px !important;" id="textarea'.$x.'" class="form-control" name="komentar" placeholder="Add a comment..."></textarea>
                <input type="submit" class="comment_box_button side-menu__suggestion-button" name="post" value="Post" />
                <input type="hidden" name="objava_id" value="'.$row['oid'].'">
                <input type="hidden" name="uporabnik_id" value="'.$_SESSION['user_id'].'">
                <input type="hidden" name="article_id" value="'.$x.'">
                <script
                src="https://code.jquery.com/jquery-3.6.0.min.js"
                ></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js">
                </script>
                <script>

                  $(document).ready(function(){
                    $("#textarea'.$x.'").emojioneArea({
                      pickerPosition:"top"
                    });
                  });

                </script>
                </div>
                </form>
            </div>
        </div>
    </article>';

}}

function time_elapsed_comment($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'y',
        'm' => 'm',
        'w' => 'w',
        'd' => 'd',
        'h' => 'h',
        'i' => 'm',
        's' => 's',

    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . '' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode('', $string) . '' : 'just now';
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',

    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function gallery($uid)
{
  include 'database.php';
  include_once 'session.php';

  $query = "SELECT *,o.id AS oid FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE uporabnik_id=? ORDER BY datum_objave DESC ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$uid]);

  $x=0;
    while ($row = $stmt->fetch()) {
        $likes=liked($row['oid']);
        $commentsC=commentCount($row['oid']);
        $x=$x+1;
        echo '  <script>
          function loadPost'.$x.'(){
            location.href = "post.php?post='.$row['oid'].'";
          }</script>';
        echo '<div class="gallery-item" tabindex="0">';
        echo '<img src="'.$row['path'].'"class="gallery-image"  alt="">';
        echo '<div onclick="loadPost'.$x.'()" class="gallery-item-info">';
        echo '<ul>';
      echo '<li><svg style="
      padding-top: 13px;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path id="fill" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="var(--text-dark)"  stroke-width="0.6"/>
      </svg></li><li class="gallery-item-likes"><span class="visually-hidden">Likes:</span></i> '.$likes.'</li>';
      echo '<li><svg style="
      padding-top: 13px;"  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2959 20.8165L20.2351 16.8602C20.1743 16.6385 20.2047 16.3994 20.309 16.1907C21.2351 14.3342 21.5438 12.117 20.9742 9.80402C20.2003 6.67374 17.757 4.16081 14.6354 3.33042C13.7833 3.10869 12.9442 3 12.1312 3C6.29665 3 1.74035 8.47365 3.31418 14.5647C4.04458 17.3819 7.05314 20.2992 9.88344 20.9861C10.6486 21.173 11.4008 21.26 12.1312 21.26C13.7006 21.26 15.1701 20.8557 16.4614 20.1601C16.6049 20.0818 16.7657 20.0383 16.9222 20.0383C17.0005 20.0383 17.0787 20.047 17.157 20.0688L21.009 21.0991C21.0307 21.1035 21.0525 21.1078 21.0699 21.1078C21.2177 21.1078 21.3351 20.9687 21.2959 20.8165ZM19.0178 17.1863L19.6178 19.4253L17.4831 18.8558C17.3005 18.8079 17.1135 18.7819 16.9222 18.7819C16.557 18.7819 16.1875 18.8775 15.8571 19.0558C14.6963 19.6818 13.4441 19.9992 12.1312 19.9992C11.4834 19.9992 10.8269 19.9166 10.1791 19.7601C7.78354 19.1775 5.14453 16.6037 4.53586 14.2473C3.90111 11.7865 4.40109 9.26057 5.90536 7.31719C7.40964 5.3738 9.6791 4.26081 12.1312 4.26081C12.8529 4.26081 13.5876 4.35646 14.3137 4.5521C16.9961 5.26511 19.0786 7.39544 19.7525 10.1084C20.2264 12.0213 20.0308 13.9299 19.183 15.6298C18.9395 16.1168 18.8787 16.6689 19.0178 17.1863Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
      </svg></li><li class="gallery-item-comments"><span class="visually-hidden">Comments:</span></i> '.$commentsC.'</li>';
      echo '</ul>';
      echo '</div>';
      echo '</div>';
  }


}

function galleryExplore()
{
  include 'database.php';
  include_once 'session.php';
  $limitExplore=$_SESSION['limitExlpore'];
  $query = "SELECT *,o.id AS oid FROM objave o INNER JOIN uporabniki u ON uporabnik_id=u.id WHERE uporabnik_id!=? ORDER BY RAND() LIMIT ? ";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_SESSION['user_id'],$limitExplore]);


$x=0;
  while ($row = $stmt->fetch()) {
      $likes=liked($row['oid']);
      $commentsC=commentCount($row['oid']);
      $x=$x+1;
      echo '  <script>
        function loadPost'.$x.'(){
          location.href = "post.php?post='.$row['oid'].'";
        }</script>';
      echo '<div class="gallery-item" tabindex="0">';
      echo '<img src="'.$row['path'].'"class="gallery-image"  alt="">';
      echo '<div onclick="loadPost'.$x.'()" class="gallery-item-info">';
      echo '<ul>';
      echo '<li><svg style="
      padding-top: 13px;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path id="fill" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="var(--text-dark)"  stroke-width="0.6"/>
      </svg></li><li class="gallery-item-likes"><span class="visually-hidden">Likes:</span></i> '.$likes.'</li>';
      echo '<li><svg style="
      padding-top: 13px;"  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2959 20.8165L20.2351 16.8602C20.1743 16.6385 20.2047 16.3994 20.309 16.1907C21.2351 14.3342 21.5438 12.117 20.9742 9.80402C20.2003 6.67374 17.757 4.16081 14.6354 3.33042C13.7833 3.10869 12.9442 3 12.1312 3C6.29665 3 1.74035 8.47365 3.31418 14.5647C4.04458 17.3819 7.05314 20.2992 9.88344 20.9861C10.6486 21.173 11.4008 21.26 12.1312 21.26C13.7006 21.26 15.1701 20.8557 16.4614 20.1601C16.6049 20.0818 16.7657 20.0383 16.9222 20.0383C17.0005 20.0383 17.0787 20.047 17.157 20.0688L21.009 21.0991C21.0307 21.1035 21.0525 21.1078 21.0699 21.1078C21.2177 21.1078 21.3351 20.9687 21.2959 20.8165ZM19.0178 17.1863L19.6178 19.4253L17.4831 18.8558C17.3005 18.8079 17.1135 18.7819 16.9222 18.7819C16.557 18.7819 16.1875 18.8775 15.8571 19.0558C14.6963 19.6818 13.4441 19.9992 12.1312 19.9992C11.4834 19.9992 10.8269 19.9166 10.1791 19.7601C7.78354 19.1775 5.14453 16.6037 4.53586 14.2473C3.90111 11.7865 4.40109 9.26057 5.90536 7.31719C7.40964 5.3738 9.6791 4.26081 12.1312 4.26081C12.8529 4.26081 13.5876 4.35646 14.3137 4.5521C16.9961 5.26511 19.0786 7.39544 19.7525 10.1084C20.2264 12.0213 20.0308 13.9299 19.183 15.6298C18.9395 16.1168 18.8787 16.6689 19.0178 17.1863Z" fill="var(--text-dark)" stroke="var(--text-dark)" stroke-width="0.7"/>
      </svg></li><li class="gallery-item-comments"><span class="visually-hidden">Comments:</span></i> '.$commentsC.'</li>';
      echo '</ul>';
      echo '</div>';
      echo '</div>';
  }


}






















?>
