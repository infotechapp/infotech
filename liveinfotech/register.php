
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
    $sql = "INSERT INTO students(name,email,mobile_number,city,address)VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["mobile_number"]."','".$_POST["city"]."','".$_POST["address"]."')";
    if (mysqli_query($conn, $sql)) {
    	if($_POST["vendor"] == 'vendor'){
    		$last_id = $conn->insert_id;
    		$sql2 = "INSERT INTO vendors(user_id,vendor_code)VALUES ('".$last_id."','".$_POST["vendor_code"]."')";
    		mysqli_query($conn, $sql2);
    	}	
       $mess = "Thank you for participating in our Quiz!";
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
	        		
		        	<h2>Registration Form </h2>
		        	<ul class="breadcrumb">
			            <li>Home</li>
			            <li><a href="#"> Registration</a></li>
		          	</ul>
	          	</div>
          	</div><!-- Subpage title end -->
	</div><!-- Banner area end -->

	<!-- Main container start -->

	<section id="main-container">
		<div id="hidemessage"><h5 style="color:#49a2e7; text-align: center;"><?php echo $mess;?></h5></div>
		<div class="container">

			<div class="row">
	    		<div class="col-md-6" style="">
	    			<form id="contact-form" action="register.php" id="saveReg" method="post" role="form">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name</label>
								<input class="form-control" name="name" id="name" placeholder="" type="text" data-validate="required" data-message-requierd="required">
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
									<label>Contact Number</label>
									<input class="form-control" name="mobile_number" id="mobile_number" 
									placeholder="" required>
								</div>
							</div>
							
						
						
							<div class="col-md-6">
								<div class="form-group">
									<label>City</label>
									<input class="form-control" name="city" id="city" 
									placeholder="" required>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Type</label>
									<select class="form-control" name="vendor" id="vendor" required>
									  <option value="student">Student</option>
									  <option value="vendor">Vendor</option>
									  
									</select>
								</div>
							</div>
							
						</div>
						<div class="row" id="vendor_cd" style="display: none">
							<div class="col-md-12">
								<div class="form-group">
									<label>Vendor Code</label>
									<input class="form-control" name="vendor_code" id="vendor_code" 
									placeholder="">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" name="address" id="address" placeholder="" rows="3" required></textarea>
						</div>
						<div class="text-center"><br>
							 
							<button type="submit" name="submit" id="btnSubmit" class="btn btn-primary solid blank">Submit</button> 
							
						</div>
					</form>
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


<script>
$(document).ready(function(){

	

	$('#hidemessage').delay(5000).fadeOut();
	jQuery("#vendor").change(function () {
       var vendor = $(this).children("option:selected").val();
       if (vendor == 'vendor') {
       		$("#vendor_cd").css("display", "block");
       }else{
       		$("#vendor_cd").css("display", "none");
       }
       
           
 });      
});
</script>