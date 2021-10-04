<?php include 'main_php/header.php';

?>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
<link rel="stylesheet" type="text/css" href="css/edit.css">
<link rel="stylesheet" type="text/css" href="css/create.css">
<link rel="stylesheet" type="text/css" href="css/error.css">
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
    <div  class="view-account">
        <section class="module">
            <div class="module-inner">

                <div style="border:none;" class="content-panel">

                    <form method="post" enctype="multipart/form-data" action="insert_post.php" class="form-horizontal">
                        <fieldset  class="fieldset">
													<h3 id="odmik2" class="fieldset-title krneki">New Post</h3>
													<div >
														<?php if (isset($_GET['error'])) { ?>
															 <p class="error"><?php echo $_GET['error']; ?></p>
														 <?php } ?>
													</div>
													<div class="post__content">
	                            <div class="post__medias">
	                                <img class="post__media" src="assets/placeholder.jpg" alt="image Preview" id="imagePreview">
	                            </div>
	                        </div>
													<div class="odmik">


                            <div class="form-group avatar">
                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="file" id="odmik" name="fileToUpload" class="file-uploader pull-left" onchange="loadfile(event)">
                                </div>
                            </div>
														<script type="text/javascript">
														function loadfile(event){
															var output=document.getElementById('imagePreview');
															output.src=URL.createObjectURL(event.target.files[0]);
														}
														</script>


														</div>

                        </fieldset>
                        <fieldset class="fieldset">

                            <div class="form-group">
                                <label id="odmik2" class="col-md-2  col-sm-3 col-xs-12 control-label">Caption</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <textarea id="textarea" class="form-control" name="bio" placeholder="Write a caption...."></textarea>
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
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="odmik2" class="col-md-2  col-sm-3 col-xs-12 control-label">Tags</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="odmik2" type="text" class="form-control" name="tags">

                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input id="odmik2" class="btn btn-primary" name="update_button" type="submit" value="Share">
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
