<?php include 'main_php/header.php';
?>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/edit.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
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

<div class="container-profile">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" id="cover" src=" <?php if (isset($user['slika_profila'])) {	echo  $user['slika_profila'] ;  } else {echo "assets/default-user.png";} ?>  " alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?php if(isset($user['username'])){
								              ?>
								              <?php echo $user['ime'];echo " ";echo $user['priimek'];}  ?>

                            </li>
                            <li class="email"><?php
								            if(isset($user['email'])){
								              ?>
								              <a href="#"><?php echo $user['email'];?></a>
								    			 <?php } ?></li>

                        </ul>
                    </div>
            		<nav class="side-menu-profile">
        				
        			</nav>
                </div>
                <div class="content-panel">
                    <h2 class="title">Profile</h2>
                    <form method="post" enctype="multipart/form-data" action="update-profile.php" class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Personal Info</h3>
                            <div class="form-group avatar">
                                <figure class="figure col-md-2 col-sm-3 col-xs-12">
                                    <img class="img-rounded img-responsive" src=" <?php if (isset($user['slika_profila'])) {	echo  $user['slika_profila'] ;  } else {echo "assets/default-user.png";} ?>  " alt="">
                                </figure>
                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="file" name="fileToUpload"  class="file-uploader pull-left">
                                    <button type="submit" name="image_button" class="btn btn-sm btn-default-alt pull-left">Update Image</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">User Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="uime" class="form-control" value="<?php echo $user['username'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">First Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="text" name="ime" class="form-control" value="<?php echo $user['ime'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">Last Name</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input name="priimek" type="text" class="form-control" value="<?php echo $user['priimek'] ?>">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Contact Info</h3>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input name="email" type="email" class="form-control" value="<?php echo $user['email'] ?>">
                                    <p class="help-block">This is the email </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Bio</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">


                                    <textarea id="textarea" class="form-control" name="bio"><?php echo $user['opis_profila']; ?></textarea>
																			<script
																			src="https://code.jquery.com/jquery-3.6.0.min.js"
																			></script>
																			<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js">
																			</script>
																			<script>
 																				$(document).ready(function(){
																					$("#textarea").emojioneArea({
																						pickerPosition:"bottom"
																					});
																				});
																			</script>
                                    <p class="help-block">Your profile description</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Number</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="tel" name="tel" class="form-control" value="<?php echo $user['telefonska'] ?>">
                                    <p class="help-block">This is the telephone number</p>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" name="update_button" type="submit" value="Update Profile">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">

</script>
<?php include 'main_php/footer.php'; ?>
