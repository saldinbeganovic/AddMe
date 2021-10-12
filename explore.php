<?php include 'main_php/header.php'; ?>
<link rel="stylesheet" type="text/css" href="css/profile.css">
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
    <main>
      <?php $_SESSION['limitExlpore']=99; ?>

    	<div id="odmikExplore" class="container">

    		<div class="gallery">

    			<?php galleryExplore(); ?>


    		</div>
    		<!-- End of gallery -->

    	<!--	<div class="loader"></div>-->


    	</div>
    	<!-- End of container -->

    </main>
<?php include 'main_php/footer.php'; ?>
