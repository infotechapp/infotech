<?php
		$url = $_SERVER['PHP_SELF'];
		$urlexp1 = explode('.', $url);
		$urlexp2 = explode('/', $urlexp1[0]);
		//print_r($urlexp2);die;
	

 ?>
<!-- Header start -->
		<header id="header" class="navbar-fixed-top header" role="banner">
			<div class="container">
				<div class="row">
					<!-- Logo start -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-brand navbar-bg">
							<a href="index.php">
								<img class="img-responsive" src="images/logo.png" alt="logo">
							</a>
						</div>
					</div>
					<!--/ Logo end -->
					<nav class="collapse navbar-collapse clearfix" role="navigation">
						<ul class="nav navbar-nav navbar-right">
							<li class="<?php if($urlexp2[1] =='index'){echo 'active';}?>">
								<a href="index.php">Home </a>
							</li>
							<li class="<?php if($urlexp2[1] =='about'){echo 'active';}?>">
								<a href="about.php">About Us </a>
							</li>
							<!-- <li class="<?php //if($urlexp2[1] =='service'){echo 'active';}?> dropdown">
								<a href="service.php">Services </a>
							</li>  -->

							<li class="<?php if($urlexp2[1] =='web-delopment' || $urlexp2[1] =='mobile-app-development' || $urlexp2[1] =='digital-market' || $urlexp2[1] =='design' || $urlexp2[1] =='testing' || $urlexp2[1] =='non-functional-testing' || $urlexp2[1] =='functional-testing'){echo 'active';}?> dropdown">
								<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-angle-down"></i></a>
								<div class="dropdown-menu">
								 <ul>
									 <li><a href="web-delopment.php">Web Development</a></li>
									 <li><a href="mobile-app-development.php">Mobile APP Development</a></li>
									 <li><a href="digital-market.php">Digital Marketing</a></li>
									 <li><a href="design.php">Design(UI/UX)</a></li>
									 <!--<li><a href="index-4.php">Software Consulting</a></li>-->
									 <li><a href="testing.php">Testing &QA</a></li>
								 </ul>
							 </div>
						 </li>

							<li class="<?php if($urlexp2[1] =='portfolio-static' || $urlexp2[1] =='portfolio-item'){echo 'active';}?>">
								<a href="portfolio-static.php">Portfolio </a>
							</li>
							<li class="<?php if($urlexp2[1] =='testimonial'){echo 'active';}?>">
								<a href="testimonial.php">Testimonials </a>
							</li>
							<li class="<?php if($urlexp2[1] =='career'){echo 'active';}?>">
								<a href="career.php">Career </a>
							</li>
							<li class="<?php if($urlexp2[1] =='contact'){echo 'active';}?>">
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</nav>
					<!--/ Navigation end -->
				</div>
				<!--/ Row end -->
			</div>
			<!--/ Container end -->
		</header>
		<!--/ Header end -->