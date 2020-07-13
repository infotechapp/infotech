<?php
ob_start();
session_start();
if(empty($_SESSION['login_id'])){       header('Location: https://infotechapp.com');     ob_end_flush();
    }

?>
<style type="text/css">
    .col-md-5.col-md-offset-1.onlinetext {
    margin-top: -200px;


}

<style>
body{
    text-align: center;
    background: #00ECB9;
  font-family: sans-serif;
  font-weight: 100;
}
</style>
<?php 	ob_start();
	session_start();
	include('head.php');

	?>
    <body>
        <!-- Page Wrapper -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
        <div id="page-wrapper">


            <div id="page-container" class="">

                <!-- END Alternative Sidebar -->

                 <?php //include('sidebar.php'); ?>

                <!-- Main Container -->
                <div id="main-container">
                    <!-- Header -->
                    <!-- In the PHP version you can set the following options from inc/config file -->
                    <!--
                        Available header.navbar classes:

                        'navbar-default'            for the default light header
                        'navbar-inverse'            for an alternative dark header

                        'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                            'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                        'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                            'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
                    -->
                    <?php include('dashboard_header.php'); ?>

                    <!-- Page content -->
                    <div id="page-content" class="pagecolor">
                        <!-- Dashboard Header -->
                        <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

                        <div class="col-md-5 col-md-offset-1 onlinetext">
                    <div id="login-alt-container">
                        <!-- Title -->
                        <h1 class="push-top-bottom">
                            <strong>Welcome to Online Quiz</strong><br>
                             <!-- <small>Powered by Infotechapp</small> -->
                        </h1>

                        <!-- END Title -->

                        <!-- Key Features -->
                        <ul class="fa-ul text-muted">
                            <li><i class="fa fa-check fa-li text-success"></i> Clean &amp; Modern Design</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Fully Responsive &amp; Retina Ready</li>
                            <li><i class="fa fa-check fa-li text-success"></i> 10 Color Themes</li>
                            <li><i class="fa fa-check fa-li text-success"></i> PSD Files Included</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Widgets Collection</li>
                            <li><i class="fa fa-check fa-li text-success"></i> Designed Pages Collection</li>
                            <li><i class="fa fa-check fa-li text-success"></i> .. and many more awesome features!</li>
                        </ul>
                        <!-- END Key Features -->
                        <div class="col-md-12 col-md-offset-3 quizbtn" style="display: none">
                            <a href="quiz.php" class="btn btn-sm btn-primary quiz"><i class="fa fa-floppy-o"></i> Start Quiz</a>
                        </div>

                    </div>
                </div>

                                        <h1 class="heading">Countdown Clock</h1>
                        <div id="clockdiv">
                          <div>
                            <span class="days" id="day"></span>
                            <div class="smalltext">Days</div>
                          </div>
                          <div>
                            <span class="hours" id="hour"></span>
                            <div class="smalltext">Hours</div>
                          </div>
                          <div>
                            <span class="minutes" id="minute"></span>
                            <div class="smalltext">Minutes</div>
                          </div>
                          <div>
                            <span class="seconds" id="second"></span>
                            <div class="smalltext">Seconds</div>
                          </div>
                        </div>

                        <p id="demo"></p>

                        <!-- END Dashboard Header -->

                        <!-- Mini Top Stats Row -->
                        <!--here middle action -->
                        <!-- END Mini Top Stats Row -->


                        <!-- END Widgets Row -->
                    </div>
                    <!-- END Page Content -->

                   <?php  include('footer.php');?>
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>



        <?php  include('common_js.php');?>

        <script>$(function(){ Index.init(); });</script>
        <script>

            var deadline = new Date("july 27, 2020 09:27:25").getTime();

            var x = setInterval(function() {

            var now = new Date().getTime();
            var t = deadline - now;
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
            var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((t % (1000 * 60)) / 1000);
            document.getElementById("day").innerHTML =days ;
            document.getElementById("hour").innerHTML =hours;
            document.getElementById("minute").innerHTML = minutes;
            document.getElementById("second").innerHTML =seconds;
            if (t < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "TIME UP";
                    document.getElementById("day").innerHTML ='0';
                    document.getElementById("hour").innerHTML ='0';
                    document.getElementById("minute").innerHTML ='0' ;
                    document.getElementById("second").innerHTML = '0';
                    $('.quizbtn').css('display','block');
                }
            }, 1000);
</script>
    </body>
</html>