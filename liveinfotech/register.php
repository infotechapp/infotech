<?php
error_reporting(1);
function getGUID()
{
    if (function_exists('com_create_guid'))
    {
        return com_create_guid();
    }
    else
    {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8)
            .substr($charid, 8, 4)
            .substr($charid,12, 4)
            .substr($charid,16, 4)
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

function password_generate($chars)
{
  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($data), 0, $chars);
}

$relativePathLogo =  'http://infotechapp.com/images/logo.png';

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

   $pass = password_generate(6);
   $md5pass = md5($pass);
   $email =  $_POST["email"];
   $datetime = date('Y-m-d H:i:s');
   $random_no = rand(10,10000);


	//Upload file start
	$ext_details = pathinfo($_FILES['image']['name']);
	$ext = strtolower($ext_details['extension']);
	$image = getGUID();
	$guid = substr($image, 1, -1);
	$img_name=$guid.'.'.$ext;
	$target = "images/student/".basename($img_name);
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$sql = "INSERT INTO students(name,father_name,roll_number,dob,email,password,real_password,mobile_number,img_name,city,address,created_at)VALUES ('".$_POST["name"]."','".$_POST["father_name"]."','".$random_no."','".$_POST["dob"]."','".$email."','".$md5pass."','".$pass."','".$_POST["mobile_number"]."','".$img_name."','".$_POST["city"]."','".$_POST["address"]."','".$datetime."')";
	    if (mysqli_query($conn, $sql)) {
	    	if($_POST["vendor"] == 'vendor'){
	    		$last_id = $conn->insert_id;
	    		$sql2 = "INSERT INTO vendors(user_id,vendor_code)VALUES ('".$last_id."','".$_POST["vendor_code"]."')";
	    		mysqli_query($conn, $sql2);
	    	}

	       //send email to the student
	    	   $subject = "Username and Password arrived";
		       $to = $email;
		       $message = "<b>Username :</b> ".$email;
		       $message .= "<b>Password :</b> ".$pass;
               $message .= "<b>Roll Number :</b> ".$random_no;
		       $header = "From:info@infotechapp.com \r\n";
			   $header .= "MIME-Version: 1.0\r\n";
			   $header .= "Content-type: text/html\r\n";
		       mail ($to,$subject,$message,$header);
	       //send email to the student

               $html = '<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Emailer</title>
                        <meta charset="utf-8">

                    </head>
                    <body>
                        <div class="emailer-container" style=" width: 100%; max-width: 1000px; border-radius: 3px; overflow: hidden; font-family: verdana, arial; margin: 30px auto; box-shadow: 0 0 10px #ddd;">
                            <span style="float: left; width: 50%; background: #0a3266; min-height: 5px;"></span><span style="float: left; width: 50%; background: #0a3266; min-height: 5px;"></span>
                            <div class="emailer-header" style="text-align: center; padding: 8px; background-color: #49a2e7; border-bottom: 3px solid #ececec">
                                <img src="' .$relativePathLogo. '" alt="Infotechapp" style="font-size: 21px; height:45px; color: #ff; font-weight: bold; ">
                            </div>

                            <div class="emailer-content" style="padding: 20px">
                                <p style="font-size: 15px; margin:0 0 15px; color: #777">Dear <strong>Sir/Madam,</strong></p>
                                <p style="font-size: 14px; margin:0 0 15px; color: #777">Welcome to Infotechapp Quiz. Please find your login details below.</p>
                                <p><b>Username:</b>"'.$email.'"</p>
                                <p><b>Password:</b> "'.$pass.'"</p>
                                <p><b>Roll Number:</b> "'.$random_no.'"</p>
                            </div>
                            <div style="margin: 30px auto; max-width: 223px; font-size: 12px; font-family: verdana, arial; background-color: #ddd; height: 1px; clear: both">© 2020 Infotechapp | All Rights Reserved.</div>
                           </div>
                           </body>
                           </html>';

    		       $header = "From:info@infotechapp.com \r\n";
                   $header .= "Cc:digital@infotechapp.com \r\n";
    			   $header .= "MIME-Version: 1.0\r\n";
    			   $header .= "Content-type: text/html\r\n";
    		       mail ($to,$subject,$html,$header);
	       //send email to the student
	       $mess = "Thank you for participating in our Quiz!";
	    } else {
	       $mess = "Error: " . $sql . "" . mysqli_error($conn);
	    }
		}else{
			$mess = "Failed to upload image";
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
            <img src="images/banner/banner1.jpg" alt="" />
            <div class="parallax-overlay"></div>
            <!-- Subpage title start -->
            <div class="banner-title-content">
                <div class="text-center">
                    <h2>Registeration Form</h2>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li><a href="javascript:void(0)">Registeration Form</a></li>
                    </ul>
                </div>
            </div><!-- Subpage title end -->
        </div><!-- Banner area end -->
        <!-- Main container start -->

        <section id="main-container">
            <div id="hidemessage">
                <h5 style="color:#49a2e7; text-align: center;"><?php echo $mess;?></h5>
            </div>
            <div class="container">

                <div class="row">
                    <div class="col-md-12" style="">
                        <form id="contact-form" action="register.php" id="saveReg" enctype="multipart/form-data" method="post" role="form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" onkeypress="return event.charCode >= 97 && event.charCode <= 122 || event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32" name="name" id="name" placeholder="" type="text"
                                            data-validate="required" data-message-requierd="required" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input class="form-control" onkeypress="return event.charCode >= 97 && event.charCode <= 122 || event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32" name="father_name" id="father_name" placeholder="" type="text"
                                            data-validate="required" data-message-requierd="required" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" id="email" placeholder="" type="email"
                                            required>
                                        <span class="EmailNameCheck"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input class="form-control" name="city" id="city" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input class="form-control" type="tel" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="mobile_number" id="mobile_number"
                                            placeholder="" required>
                                    </div>
                                </div>
								<div class="col-md-4">
									<div class="form-group">
                                        <label class="control-label">Type</label>
                                        <select class="form-control" name="vendor" id="vendor" required>
                                            <option value="student">Student</option>
                                            <option value="vendor">Vendor</option>

                                        </select>
                                    </div>
								</div>
								<div class="col-md-4" id="vendor_cd" style="display: none">
									<div class="form-group">
                                        <label>Vendor Code</label>
                                        <input class="form-control" name="vendor_code" id="vendor_code" placeholder="">
                                    </div>
								</div>
                            </div>
							<div class="row">

                                <div class="col-md-4">
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control" name="address" id="address" placeholder="" rows="3"
											required></textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Birthday (DOB)</label><br>
										<input type="date" class="form-control" name="dob" required>
									</div>
								</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" class="form-control" accept="image/*" name="image" id="image" required>
                                    </div>
                                </div>
							</div>

                            <div class="text-center"><br>

                                <button type="submit" name="submit" id="btnSubmit"
                                    class="btn btn-primary solid blank">Submit</button>

                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <!--/ container end -->

        </section>
        <!--/ Main container end -->


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
$(document).ready(function() {



    $('#hidemessage').delay(5000).fadeOut();
    jQuery("#vendor").change(function() {
        var vendor = $(this).children("option:selected").val();
        if (vendor == 'vendor') {
            $("#vendor_cd").css("display", "block");
        } else {
            $("#vendor_cd").css("display", "none");
        }


    });

    $(document).on('focusout', 'input[name=email]', function () {
            var email = $(this).val();
            var thisIs = $(this);
            if (email == "") {
                $(".EmailNameCheck").text("");
                return false;
            }

            $.ajax({
                url: "checkEmailAjax.php",
                type: "post",
                data: {email: email},
                success: function (data) {

                    if (data > 0) {
                        $(".EmailNameCheck").html('Email already Exist! ').css('color', '#cc2424');
                        $("#btnSubmit").prop('disabled', true);
                        $("#btnSubmit").addClass("btn-default").removeClass("btn-primary");
                        setTimeout(function () {
                            $(".EmailNameCheck").text("");
                        }, 5000);
                        return false;
                    } else if (data == 0) {
                        //$(".EmailNameCheck").html('Email is Available!').css('color', 'green');
                        $("#btnSubmit").prop('disabled', false);
                        $("#btnSubmit").addClass("btn-primary").removeClass("btn-default");
                        // setTimeout(function () {
                        //     $(".EmailNameCheck").text("");
                        // }, 5000);
                    }
                }
            });

        });


});
</script>