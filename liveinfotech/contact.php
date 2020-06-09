<?php 
error_reporting(1);
if(isset($_POST["submit"]))
{
	$servername = "148.66.145.21";
    $username = "infotechapp";
    $password = "eG7GN!A$3Lh9";
    $dbname = "infotechapp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "INSERT INTO contact(name,email,mobile_number,subject,purpose,message)VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobile_number"]."','".$_POST["subject"]."','".$_POST["purpose"]."','".$_POST["message"]."')";
    if (mysqli_query($conn, $sql)) {	
       $mess = "Thank You! We will contact you shortly…";
    } else {
       $mess = "Error: " . $sql . "" . mysqli_error($conn);
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
	<?php include "include/head.php"; ?>
	
<body>
	<div class="body-inner">
	<!-- Header start -->
	<?php include "include/header.php"; ?>

	<div id="banner-area">
		<img src="images/banner/banner6.jpg" alt ="" />
		<div class="parallax-overlay"></div>
			<!-- Subpage title start -->
			<div class="banner-title-content">
	        	<div class="text-center">
	        		
		        	<h2>Contact Us</h2>
		        	<ul class="breadcrumb">
			            <li>Home</li>
			            <li><a href="#"> Contact</a></li>
		          	</ul>
	          	</div>
          	</div><!-- Subpage title end -->
	</div><!-- Banner area end -->

	<!-- Main container start -->

	<section id="main-container">
		<div id="hidemessage"><h5 style="color:#49a2e7; text-align: center;"><?php echo $mess;?></h5></div>
		<div class="container">

			<div class="row">
	    		<div class="col-md-7">
	    			<form id="contact-form" action="contact.php" method="post" role="form">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
								<input class="form-control" name="name" id="name" placeholder="" type="text" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" name="email" id="email" 
									placeholder="" type="email" required>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile Number</label>
									<input class="form-control" name="mobile_number" id="mobile_number" 
									placeholder="" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Subject</label>
									<input class="form-control" name="subject" id="subject" 
									placeholder="" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Purpose</label>
									<select class="form-control" name="purpose" id="purpose" required>
									  <option value="Web Development">Web Development</option>
									  <option value="Mobile App Development">Mobile App Development</option>
									  <option value="Digital Marketing">Digital Marketing</option>
									  <option value="Other">Other</option>
									</select>
								</div>
							</div>
							
						</div>
						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control" name="message" id="message" placeholder="" rows="5" required></textarea>
						</div>
						<div class="text-right"><br>
							 
							<input class="btn btn-primary solid blank" type = "submit" value ="Send Message" name = "submit"/>
						</div>
					</form>
	    		</div>
	    		<div class="col-md-5">
	    			<div class="contact-info">
		    			<h3>Contact Details</h3>
			    		
			    		
			    		<p><i class="fa fa-home info"></i>  Main Road, Sector 14 Gurgaon, Haryana </p>
						<p><i class="fa fa-phone info"></i>  +91-8899293353, +91-8523882090 </p>
						<p><i class="fa fa-envelope-o info"></i>  info@infotechapp.com</p>
						<p><i class="fa fa-globe info"></i>  www.infotechapp.com</p>
    				</div>
	    		</div>
	    	</div>

		</div><!--/ container end -->

	</section><!--/ Main container end -->
	

	<?php include "include/footer.php"; ?>
	<?php include "include/commonjs.php"; ?>

	<!-- Google Map API Key Source -->
	<!-- <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCsa2Mi2HqyEcEnM1urFSIGEpvualYjwwM"></script> -->
	<!-- Doc https://developers.google.com/maps/documentation/javascript/get-api-key -->
	<!-- <script type="text/javascript" src="js/gmap3.js"></script> -->

	<!-- <script type="text/javascript">

		$(function () {
	       $('#map')
	         .gmap3({
	           address:"14600 Goldenwest St #101A, Westminster, California 92683",
	           zoom: 17,
	           mapTypeId : google.maps.MapTypeId.ROADMAP,
	           scrollwheel: false
	         })
	         .marker(function (map) {
	           return {
	             position: map.getCenter(),
	             icon: 'http://themewinter.com/html/marker.png'
	           };
	         });
	     });

	</script> -->

	
	<!-- Template custom -->
	
	</div><!-- Body inner end -->
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#hidemessage').delay(5000).fadeOut()
});
</script>