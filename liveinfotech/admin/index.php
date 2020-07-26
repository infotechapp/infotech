<?php
		include 'function/database.php';
		 include('head.php');
        date_default_timezone_set('Asia/Kolkata');
        session_start();
        ob_start();
        function get_client_ip() {
             $ipaddress = '';
             if (getenv('HTTP_CLIENT_IP'))
                 $ipaddress = getenv('HTTP_CLIENT_IP');
             else if(getenv('HTTP_X_FORWARDED_FOR'))
                 $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
             else if(getenv('HTTP_X_FORWARDED'))
                 $ipaddress = getenv('HTTP_X_FORWARDED');
             else if(getenv('HTTP_FORWARDED_FOR'))
                 $ipaddress = getenv('HTTP_FORWARDED_FOR');
             else if(getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
             else if(getenv('REMOTE_ADDR'))
                 $ipaddress = getenv('REMOTE_ADDR');
             else
                 $ipaddress = 'UNKNOWN';
             return $ipaddress;
        }
       // Generate token
        function getToken($length){
         $token = "";
         $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
         $codeAlphabet.= "0123456789";
         $max = strlen($codeAlphabet); // edited

         for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[random_int(0, $max-1)];
         }

         return $token;
        }

	if(isset($_POST['login-email'])){
        $datetime = date('Y-m-d H:i:s');
		$email        = trim($_POST['login-email']);
		$password     = md5($_POST['login-password']);

        //check username and pass exists or not
		$sqlinner = "select id,name,quiz from students where email = '".$email."' and password='".$password."'";
        $result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));
        $countData = mysqli_num_rows($result2);
		$row = mysqli_fetch_array($result2);

        //check username and pass exists or not

        //check status active or not
        $sqlinner2 = "select id,name,quiz from students where email = '".$email."' and password='".$password."' and active_status='0'";
        $result3 = mysqli_query($conn, $sqlinner2) or die(mysqli_error($conn));
        $countstatus = mysqli_num_rows($result3);
        //check status active or not

		if($countData > 0 && $countstatus > 0){
            if($row['quiz'] == 0 || $row['quiz'] == 1){
                $token = getToken(10);
                $_SESSION['token'] = $token;
    			$_SESSION['login_id']= $row['id'];
    			$_SESSION['first_name']= $row['name'];

                //echo "<pre>";
               // print_r($_SESSION);die;

                //Check token exists in the table
                $sqltoken = "select * from user_token where name = '".$row['name']."'";
                $resulttoken = mysqli_query($conn, $sqltoken) or die(mysqli_error($conn));
                $countToken = mysqli_num_rows($resulttoken);
                if($countToken > 0){
                     $sqltokenUpdate = "update user_token set token = '".$token."',created_at = '".$datetime."' where name='".$row['name']."'";
                     mysqli_query($conn, $sqltokenUpdate) or die(mysqli_error($conn));
                }else{
                     $sqltokenInsert = "INSERT INTO user_token(name,token,created_at)VALUES ('".$row['name']."','".$token."','".$datetime."')";
                     mysqli_query($conn, $sqltokenInsert);
                }
                //Check token exists in the table

                // create the user logs start
                $ipadd = get_client_ip();
                $sqllgs = "INSERT INTO login_logs(user_id,name,ip_address,created_at)VALUES ('".$row['id']."','".$row['name']."','".$ipadd."','".$datetime."')";
                mysqli_query($conn, $sqllgs);
                // create the user logs end

    			header("Location: dashboard.php");
    			ob_end_flush();
            }else{
                header("Location: index.php?message=quiz");
            }
		}elseif ($countData == 0) {
           header("Location: index.php?message=fail");
        }elseif ($countData > 0 && $countstatus == 0) {
           header("Location: index.php?message=active");
        }
	}
	?>

<body>


    <?php if(@$_GET['message'] == 'fail'){ ?>

    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>


            <p>
                User Name or Password Incorrect!</p>
        </div>
    </div>

    <?php }elseif(@$_GET['message'] == 'logout'){  ?>

    <div class="custom-alert">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>


            <p>
                You have successfully logout!</p>
        </div>
    </div>


    <?php }elseif (@$_GET['message'] == 'active') {?>
    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <p>
                Account is not active. Please contact to the admin!</p>
        </div>
    </div>
    <?php }elseif (@$_GET['message'] == 'quiz') {?>
    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <p>
                Quiz expired. Please contact to the admin!</p>
        </div>
    </div>
    <?php }elseif (@$_GET['message'] == 'alreadyLogin') {?>
    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <p>
                Someone else is already logged on using this user ID. Please contact to the admin!</p>
        </div>
    </div>
    <?php }?>

    <!-- Login Container -->
    <div id="login-container1" class="animation-fadeIn">

        <!-- Login Title -->
        <div class="login-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3 col-xs-3 text-right">
                        <img src="img/exam.png" alt="Login logo">
                    </div>
                    <div class="col-md-9 col-xs-9 text-left">
                        <h3 class="header-quiz" style='line-height: 2;'>Online Quiz</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <text>Powered by</text>
                    <a href="index.php">
                        <img src="img/logo.png" width="138px" alt="Login logo">
                    </a> -->
                </div>
            </div>
        </div>
        <!-- END Login Title -->

        <!-- Login Block -->
        <div class="block push-bit">
            <!-- Login Form -->
            <form action="" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                            <input type="text" id="login-email" name="login-email" class="form-control input-lg"
                                placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                            <input type="password" id="login-password" name="login-password"
                                class="form-control input-lg" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <!--div class="col-xs-4">
                            <label class="switch switch-primary" data-toggle="tooltip" title="Remember Me?">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me" checked>
                                <span></span>
                            </label>
                        </div-->
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-angle-right"></i> Login to
                            Quiz...</button>
                    </div>
                </div>
                <!--div class="form-group">
                        <div class="col-xs-12 text-center">
                            <a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a> -
                            <a href="javascript:void(0)" id="link-register-login"><small>Create a new account</small></a>
                        </div>
                    </div-->
            </form>
            <!-- END Login Form -->




        </div>
        <!-- END Login Block -->

        <?php  include('footer.php');?>
        <?php  include('common_js.php');?>
    </div>
    <!-- END Login Container -->




    <!-- Load and execute javascript code used only in this page -->

    <script>
    $(function() {
        Login.init();
    });
    </script>
</body>

</html>