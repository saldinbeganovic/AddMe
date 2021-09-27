
<?php include 'main_php/header.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <header>

    	<div class="container">

    		<div class="profile">

    			<div class="profile-image">

    				<img src="assets/default-user.png" alt="">

    			</div>

    			<div class="profile-user-settings">
            <?php
            if(isset($_SESSION['username'])){
              ?>
              <h1 class="profile-user-name" id="text-dark"><?php echo $_SESSION['username']; ?></h1>
    			 <?php } ?>

    				<button class="btn profile-edit-btn">Edit Profile</button>

    				<button class="btn profile-settings-btn" aria-label="profile settings"><i class="fas fa-cog" aria-hidden="true"></i></button>

    			</div>

    			<div class="profile-stats">

    				<ul>
    					<li><span class="profile-stat-count" id="text-dark">164</span> posts</li>
    					<li><span class="profile-stat-count" id="text-dark">188</span> followers</li>
    					<li><span class="profile-stat-count" id="text-dark">206</span> following</li>
    				</ul>

    			</div>

    			<div class="profile-bio">
            <?php
            if(isset($_SESSION['username'])){
              ?>
            <span class="profile-real-name" id="text-dark"><?php echo $_SESSION['ime'];echo " ";echo $_SESSION['priimek']; ?></span><?php } ?>
    				<p >Lorem ipsum dolor sit, amet consectetur adipisicing elit 📷✈️🏕️</p>

    			</div>

    		</div>
    		<!-- End of profile section -->

    	</div>
    	<!-- End of container -->

    </header>

    <main>

    	<div class="container">

    		<div class="gallery">

    			<div class="gallery-item" tabindex="0">

    				<img src="assets/insta-clone.png" class="gallery-image" alt="">

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 56</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 89</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 5</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 42</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 38</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 47</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 94</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 3</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 52</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 4</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 66</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Gallery</span><i class="fas fa-clone" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 45</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 34</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 1</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 41</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 0</li>
    					</ul>

    				</div>

    			</div>

    			<div class="gallery-item" tabindex="0">

            <img src="assets/insta-clone.png" class="gallery-image" alt="">


    				<div class="gallery-item-type">

    					<span class="visually-hidden">Video</span><i class="fas fa-video" aria-hidden="true"></i>

    				</div>

    				<div class="gallery-item-info">

    					<ul>
    						<li class="gallery-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 30</li>
    						<li class="gallery-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 2</li>
    					</ul>

    				</div>

    			</div>

    		</div>
    		<!-- End of gallery -->

    	<!--	<div class="loader"></div>-->

    	</div>
    	<!-- End of container -->

    </main>
<?php include 'main_php/footer.php'; ?>