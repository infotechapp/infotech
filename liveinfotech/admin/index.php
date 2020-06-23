<?php session_start();
ob_start();
		include 'function/database.php';
		include('head.php');
	if(isset($_POST['login-email'])){
			
		$email        = trim($_POST['login-email']);
		$password     = md5($_POST['login-password']);
		
		$sqlinner = "select id,name from students where email = '".$email."' and password='".$password."'";
        $result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));  
        $countData = mysqli_num_rows($result2); 
		$row = mysqli_fetch_array($result2);
		if($countData > 0){
			$_SESSION['login_id']= $row['id']; 
			$_SESSION['first_name']= $row['name']; 
			header("Location: dashboard.php");
			ob_end_flush();
		}else{
			header("Location: index.php?message=fail");
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
		
		
	<?php } ?>
		
        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
			
            <!-- Login Title -->
            <!-- <div class="login-title text-center">
                 <img src="img/shafolo.png" alt="Login logo">
            </div> -->
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <form action="" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="login-email" name="login-email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="login-password" name="login-password" class="form-control input-lg" placeholder="Password">
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
                        <div class="col-xs-8 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Login to Quiz...</button>
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
        
        <script>$(function(){ Login.init(); });</script>
    </body>
</html>