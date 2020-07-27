<?php
ob_start();
session_start();
include('check_token.php');
include 'function/database.php';
if(empty($_SESSION['login_id'])){       header('Location: http://infotechapp.com');     ob_end_flush();
}


if(isset($_POST['submit'])){
    $md5pass = md5($_POST["newPassword"]);
    if ($_POST["newPassword"]) {
        mysqli_query($conn, "UPDATE students set real_password='" . $_POST["newPassword"] . "',password='".$md5pass."' WHERE id='" . $_SESSION["login_id"] . "'");
        header("Location: dashboard.php?message=success"); 
    } else{
        header("Location: dashboard.php?message=error"); 
    }
}

    

?>
<style type="text/css">
body {
    /* text-align: center; */
    background: #00ECB9;
    font-family: sans-serif;
    font-weight: 100;
}
.col-md-12.changepass {
    padding: 113px;
}
</style>
<?php

	include('head.php');

	?>

<body>
 
    <div id="page-wrapper" >


        <div id="page-container" class="">

            <!-- END Alternative Sidebar -->

            <?php //include('sidebar.php'); ?>

            <!-- Main Container -->
            <div id="main-container">
              
                <?php include('dashboard_header.php'); ?>

                <!-- Page content -->
                <div id="page-content" class="pagecolor">

                    <div class="row">
                            <div class="col-md-12 changepass">
                                <!-- Form Validation Example Block -->
                                <div class="block">
                                    <!-- Form Validation Example Title -->
                                    <div class="block-title">
                                        <h2><strong>Change</strong> Password</h2>
                                    </div>
                                    <!-- END Form Validation Example Title -->

                                    <!-- Form Validation Example Content -->
                                    <form name="frmChange" action="" method="post" enctype="multipart/form-data" onSubmit="return validatePassword()" class="form-horizontal form-bordered">
                                      
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">New Password</label>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control" minlength="6" required name="newPassword" placeholder="New Password" id="new_pass"/>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Confirm Password</label>
                                            <div class="col-md-4">
                                                <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" id="confirm_pass"/>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                
                                                <input type="submit" name="submit" value="Submit" class="btn btn-sm btn-primary">
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- END Validation Block -->
                            </div>
                           
                        </div>
                   
                </div>
                <!-- END Page Content -->

                <?php  include('footer.php');?>
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php  include('common_js.php');?>

    <script>
function validatePassword() {
  var new_pass = $("#new_pass").val();
  var confirm_pass = $("#confirm_pass").val();
  if(!new_pass){
    alert('Password is required');
    return false;
  }
  else if(!confirm_pass) {
    alert('Confirm Password is required');
    return false;
  }
  else if(new_pass != confirm_pass) {
    alert('Passwords do not match');
    return false;
  }
}
</script>

</body>

</html>
