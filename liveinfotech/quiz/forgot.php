<?php
		include 'function/database.php';
		 include('head.php');


        function password_generate($chars)
        {
          $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          return substr(str_shuffle($data), 0, $chars);
        } 
        if(isset($_POST['login-email'])){
            $email = trim($_POST['login-email']);
            $pass = password_generate(6);
            $md5pass = md5($pass);
           
            //check username and pass exists or not
            $sqlinner = "select id from students where email = '".$email."'";
            $result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));
            $countData = mysqli_num_rows($result2);
            //check username and pass exists or not

            if($countData > 0 ){

                $sqlUpdate = "update students set password = '".$md5pass."',real_password = '".$pass."' where email='".$email."'";
                mysqli_query($conn, $sqlUpdate) or die(mysqli_error($conn));


                $html = '<div class="emailer-content" style="padding: 20px">
                                    <p style="font-size: 15px; margin:0 0 15px; color: #777">Dear <strong>Sir/Madam,</strong></p>
                                    <p style="font-size: 14px; margin:0 0 15px; color: #777">Please find your updated password below.</p>
                                    <p><b>Password:</b> '.$pass.'</p>
                                    
                                </div>';
                       
                $to = $email;
                $subject = 'Welcome to Online Quiz';
                $from = 'infotechapp2020@gmail.com';
                 
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                 
                // Create email headers
                $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    
                mail($to, $subject, $html, $headers);
                header("Location: index.php?message=forgot");  
        }
        else 
        {
           header("Location: forgot.php?message=doesnotexist");
        }
    }
    ?>

<body>

    <?php if(@$_GET['message'] == 'doesnotexist'){ ?>

    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <p>
                Email doesn't exist. Please enter a registered email address</p>
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
                        <h3 class="header-quiz" style='line-height: 2;'>Online Quiz (Forgot Password)</h3>
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
                                placeholder="Please Enter Email">
                            
                        </div>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-12 text-center">
                        <button type="submit" id="btnSubmit" class="btn btn-lg btn-primary"><i class="fa fa-angle-right"></i>Submit</button>
                    </div>
                </div>
                
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