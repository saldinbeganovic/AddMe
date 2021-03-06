<?php
include_once 'functions/session.php';
include "functions/function.php";
if(!isset($_SESSION['user_id'])){ //if login in session is not set
    header("Location: login-form.php");
}
 $user=get_user(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>AddMe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="assets/icons/favico.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">


    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


</head>

<body>
  <header class="header">
      <nav class="header__content">
          <div class="header__buttons">
              <a href="index.php" class="header__home">
                  <img src="assets/icons/logo-fav.png" alt="logo" width="110px" height="50px">
              </a>

          </div>
          
          <div class="header__search">
              <input type="text" placeholder="Search">
              <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path  fill-rule="evenodd" clip-rule="evenodd" d="M21.669 21.6543C21.8625 21.4622 21.863 21.1494 21.6703 20.9566L17.3049 16.5913C18.7912 14.9327 19.7017 12.7525 19.7017 10.3508C19.7017 5.18819 15.5135 1 10.3508 1C5.18819 1 1 5.18819 1 10.3508C1 15.5135 5.18819 19.7017 10.3508 19.7017C12.7624 19.7017 14.9475 18.7813 16.606 17.2852L20.9739 21.653C21.1657 21.8449 21.4765 21.8454 21.669 21.6543ZM1.9843 10.3508C1.9843 5.7394 5.7394 1.9843 10.3508 1.9843C14.9623 1.9843 18.7174 5.7394 18.7174 10.3508C18.7174 14.9623 14.9623 18.7174 10.3508 18.7174C5.7394 18.7174 1.9843 14.9623 1.9843 10.3508Z" fill="#A5A5A5" stroke="#A5A5A5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
          </div>

          <div class="header__buttons header__buttons--mobile">
              <a href="create_post.php">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="3" y="3" width="18" height="18" rx="5" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"#bcccdc" ?>" stroke-width="1.8"/>
                      <line x1="12.1" y1="6.9" x2="12.1" y2="17.1" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"#bcccdc" ?>" stroke-width="1.8" stroke-linecap="round"/>
                      <line x1="6.9" y1="11.8" x2="17.1" y2="11.8" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"#bcccdc" ?>" stroke-width="1.8" stroke-linecap="round"/>
                  </svg>
              </a>

              <a href="#">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.81038 19.7478C5.83176 19.4539 5.70787 19.1681 5.47873 18.9827C3.2792 17.2037 1.9 14.5525 1.9 11.5868C1.9 6.27627 6.38748 1.9 12.0098 1.9C17.6196 1.9 22.1078 6.27565 22.1078 11.5868C22.1078 16.8966 17.6092 21.2735 11.998 21.2735C11.0656 21.2735 10.1798 21.1544 9.32697 20.9277C9.15685 20.8825 8.97721 20.8882 8.81028 20.944L5.64643 22.0022L5.81038 19.7478Z" stroke="var(--text-dark)" stroke-width="1.8" stroke-linejoin="round"/>
                      <path d="M10.1498 8.7952C10.2222 8.80563 10.2825 8.81606 10.3548 8.82649C11.428 9.05591 12.5252 10.0362 13.3693 10.6202C13.8396 10.9539 14.2375 10.9226 14.7078 10.6097C15.7086 9.92147 16.7456 9.26448 17.7705 8.58664C18.0478 8.39893 18.3372 8.20079 18.6748 8.45107C19.0486 8.7222 18.8195 9.0142 18.6266 9.28534C17.6137 10.6827 16.6129 12.0801 15.588 13.4671C14.8886 14.4265 13.8999 14.5621 12.8388 13.8842C12.1032 13.4045 11.3436 12.9561 10.6201 12.4556C10.1378 12.1219 9.73984 12.1636 9.28163 12.4764C8.26876 13.1647 7.24382 13.8217 6.21889 14.4995C5.94156 14.6872 5.65216 14.8854 5.31454 14.6247C4.97691 14.3744 5.15778 14.0928 5.33865 13.8321C6.3877 12.393 7.42469 10.9539 8.47374 9.51476C8.82343 9.02463 9.47456 8.73263 10.1498 8.7952Z" fill="var(--text-dark)"/>
                  </svg>
              </a>
              <a href="functions/logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="var(--text-dark)" d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z"/></svg>
              </a>
          </div>

          <div class="header__buttons header__buttons--desktop">
              <a href="index.php">
                  <svg class="styled-element" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path id="child"  d="M2.45307 11.751L11.9773 2.02175L21.5015 11.751C21.7906 12.0463 21.9545 12.4468 21.9545 12.8711V20.4556C21.9545 20.7747 21.7037 21 21.4427 21H15.964C15.713 21 15.4721 20.7849 15.4721 20.476V15.8886C15.4721 13.9497 13.9267 12.34 11.9773 12.34C10.0279 12.34 8.48244 13.9497 8.48244 15.8886V20.476C8.48244 20.7849 8.24157 21 7.99053 21H2.51187C2.25085 21 2 20.7747 2 20.4556V12.8711C2 12.4468 2.16397 12.0463 2.45307 11.751Z" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="index.php")?"#2888DA":"var(--text-dark)" ?>" stroke-width="2"/>
                  </svg>
              </a>
              <a href="create_post.php">
                  <svg class="styled-element" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect id="child" x="3" y="3" width="18" height="18" rx="5" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"var(--text-dark)" ?>" stroke-width="1.8"/>
                      <line id="child" x1="12.1" y1="6.9" x2="12.1" y2="17.1" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"var(--text-dark)" ?>" stroke-width="1.8" stroke-linecap="round"/>
                      <line id="child" x1="6.9" y1="11.8" x2="17.1" y2="11.8" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="create_post.php")?"#2888DA":"var(--text-dark)" ?>" stroke-width="1.8" stroke-linecap="round"/>
                  </svg>
              </a>
              <a href="#">
                  <svg class="styled-element" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path id="child"  d="M5.81038 19.7478C5.83176 19.4539 5.70787 19.1681 5.47873 18.9827C3.2792 17.2037 1.9 14.5525 1.9 11.5868C1.9 6.27627 6.38748 1.9 12.0098 1.9C17.6196 1.9 22.1078 6.27565 22.1078 11.5868C22.1078 16.8966 17.6092 21.2735 11.998 21.2735C11.0656 21.2735 10.1798 21.1544 9.32697 20.9277C9.15685 20.8825 8.97721 20.8882 8.81028 20.944L5.64643 22.0022L5.81038 19.7478Z" stroke="var(--text-dark)" stroke-width="1.8" stroke-linejoin="round"/>
                      <path id="child" d="M10.1498 8.7952C10.2222 8.80563 10.2825 8.81606 10.3548 8.82649C11.428 9.05591 12.5252 10.0362 13.3693 10.6202C13.8396 10.9539 14.2375 10.9226 14.7078 10.6097C15.7086 9.92147 16.7456 9.26448 17.7705 8.58664C18.0478 8.39893 18.3372 8.20079 18.6748 8.45107C19.0486 8.7222 18.8195 9.0142 18.6266 9.28534C17.6137 10.6827 16.6129 12.0801 15.588 13.4671C14.8886 14.4265 13.8999 14.5621 12.8388 13.8842C12.1032 13.4045 11.3436 12.9561 10.6201 12.4556C10.1378 12.1219 9.73984 12.1636 9.28163 12.4764C8.26876 13.1647 7.24382 13.8217 6.21889 14.4995C5.94156 14.6872 5.65216 14.8854 5.31454 14.6247C4.97691 14.3744 5.15778 14.0928 5.33865 13.8321C6.3877 12.393 7.42469 10.9539 8.47374 9.51476C8.82343 9.02463 9.47456 8.73263 10.1498 8.7952Z" fill="var(--text-dark)"/>
                  </svg>
              </a>
              <a href="explore.php">
                  <svg class="styled-element" aria-label="Find People" class="_8-yf5 " color="#bcccdc" fill="<?php  echo (basename($_SERVER['PHP_SELF'])=="explore.php")?"#2888DA":"#bcccdc" ?>" height="24" role="img" viewBox="0 0 48 48" width="24"><path stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="explore.php")?"#2888DA":"var(--text-dark)" ?>" id="child" clip-rule="evenodd" d="M24 0C10.8 0 0 10.8 0 24s10.8 24 24 24 24-10.8 24-24S37.2 0 24 0zm0 45C12.4 45 3 35.6 3 24S12.4 3 24 3s21 9.4 21 21-9.4 21-21 21zm10.2-33.2l-14.8 7c-.3.1-.6.4-.7.7l-7 14.8c-.3.6-.2 1.3.3 1.7.3.3.7.4 1.1.4.2 0 .4 0 .6-.1l14.8-7c.3-.1.6-.4.7-.7l7-14.8c.3-.6.2-1.3-.3-1.7-.4-.5-1.1-.6-1.7-.3zm-7.4 15l-5.5-5.5 10.5-5-5 10.5z" fill-rule="evenodd"></path></svg>
              </a>
              <a href="notifications.php">
                  <svg class="styled-element" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path id="child" d="M11.4995 21.2609C11.1062 21.2609 10.7307 21.1362 10.4133 20.9001C8.2588 19.3012 3.10938 15.3239 1.81755 12.9143C0.127895 9.76543 1.14258 5.72131 4.07489 3.89968C5.02253 3.31177 6.09533 3 7.18601 3C8.81755 3 10.3508 3.66808 11.4995 4.85726C12.6483 3.66808 14.1815 3 15.8131 3C16.9038 3 17.9766 3.31177 18.9242 3.89968C21.8565 5.72131 22.8712 9.76543 21.186 12.9143C19.8942 15.3239 14.7448 19.3012 12.5902 20.9001C12.2684 21.1362 11.8929 21.2609 11.4995 21.2609ZM7.18601 4.33616C6.34565 4.33616 5.5187 4.57667 4.78562 5.03096C2.43888 6.49183 1.63428 9.74316 2.99763 12.2819C4.19558 14.5177 9.58639 18.6242 11.209 19.8267C11.3789 19.9514 11.6158 19.9514 11.7856 19.8267C13.4082 18.6197 18.799 14.5133 19.997 12.2819C21.3603 9.74316 20.5557 6.48738 18.209 5.03096C17.4804 4.57667 16.6534 4.33616 15.8131 4.33616C14.3425 4.33616 12.9657 5.04878 12.0359 6.28696L11.4995 7.00848L10.9631 6.28696C10.0334 5.04878 8.6611 4.33616 7.18601 4.33616Z" fill="var(--text-dark)" stroke="<?php  echo (basename($_SERVER['PHP_SELF'])=="notifications.php")?"#2888DA":"var(--text-dark)" ?>" stroke-width="0.6"</path>
                  </svg>
              </a>
              <?php if (isAdmin($_SESSION['user_id'])) {
                ?>  <a href="admin/index.php">
                <img src="https://img.icons8.com/material-rounded/24/bcccdc/admin-settings-male.png"/>
                  </a><?php
              } else {

              }?>


              <a href="profile.php">
              <button class="<?php  echo (basename($_SERVER['PHP_SELF'])=="profile.php" or basename($_SERVER['PHP_SELF'])=="edit-profile.php")?"active-img":"profile-button" ?>">
                  <div class="profile-button__border"></div>
                  <div class="profile-button__picture">
                      <img id="slika" src="<?php if (isset($user['slika_profila'])) {	echo  $user['slika_profila'] ;  } else {echo "assets/default-user.png";} ?>" alt="User Picture">
                  </div>
              </button>
              </a>
          </div>
      </nav>
  </header>
