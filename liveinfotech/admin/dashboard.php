<?php
ob_start();
session_start();
include('check_token.php');
if(empty($_SESSION['login_id'])){       header('Location: http://infotechapp.com');     ob_end_flush();
    }

?>
<style type="text/css">
body {
    /* text-align: center; */
    background: #00ECB9;
    font-family: sans-serif;
    font-weight: 100;
}
</style>
<?php

	include('head.php');

	?>

<body>
    <!-- Page Wrapper -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
    <div id="page-wrapper" >


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

                <?php if(@$_GET['message'] == 'success'){  ?>

    <div class="custom-alert">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>


            <p> Your password has been changed successfully! Thank you</p>
        </div>
    </div>
<?php }elseif (@$_GET['message'] == 'error') {?>
    <div class="custom-alert">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <p>
                Error to change your password!</p>
        </div>
    </div>
<?php }?>

                <!-- Page content -->
                <div id="page-content" class="pagecolor">
                    <!-- Dashboard Header -->
                    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
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
                    <div id="login-alt-container">
                                <!-- Title -->
                                <h1 class="push-top-bottom">
                                    <strong>Instructions for Online Quiz</strong><br>
                                    <!-- <small>Powered by Infotechapp</small> -->
                                </h1>

                                <!-- END Title -->

                                <!-- Key Features -->
                                <ul class="fa-ul text-light">
                                    <li><h4>1. Read carefully the instructions before starting the test</h4>
                                    </li>
                                    <li><h4>2. You have 60 minutes to complete the test.</h4>
                                    </li>
                                    <li><h4>3. The test contains a total of 200 questions.</h4>
                                    </li>
                                    <li><h4>4. There is only one correct answer to each question. Click on the most appropriate option to mark it as your answer.</h4>
                                    </li>
                                    <li><h4>5. You will be awarded 1 marks for each correct answer.</h4>
                                    </li>
                                    <li><h4>6. There is no negative marks for each wrong answer.</h4>
                                    </li>
                                    <li><h4>7. A Number list of all questions appears at the center of the window.</h4>
                                    </li>
                                    <li><h4>8. You can use rough sheets while taking the test. Do not use calculators, log tables, dictionaries, or any other printed/online reference material during the test.</h4>
                                    </li>
                                    <li><h4>9. Do not click the button "End TEST" before completing the test. A test once submitted cannot be resumed.</h4>
                                    </li>
                                    <li><h4>10. Once clicked on the (End TEST) button, You Cannot UNDO this Test.</h4>
                                    </li>
                                    <li><h4>11. After clicked on the (End TEST) You get your RESULT sheet on mention date 12-03-2020 (http://www.infotechapp.com/result).</h4>
                                    </li>
                                    <li><h4>12. After Complete the test Please logout your account for security purpose.</h4>
                                    </li>
                                    <li><h4>13. 1st 3 Winners will get Prize money</h4>
                                    </li>
                                </ul>
                                <label class="text-info disclaimer">
                                <input type="checkbox" id='disclaimer'>
                                I have read and understood all the instructions. Exammination center provide All computer hardwares alloted to me are in proper working condition. I agree to give the exam.
                                <span></span>
                            </label>
                            </div>

                    <!-- END Key Features -->
                    <div class="quizbtn">
                        <a href="javascript:void(0)" class="btn btn-lg btn-primary quiz"><i class="fa fa-floppy-o"></i>
                            Start Quiz</a>
                    </div>

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
    <!-- <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a> -->


    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php  include('common_js.php');?>

    <script>

    $('.quiz').click(function() {
            if($('#disclaimer').prop("checked") == true){
                window.open("quiz.php", "_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
            }
            else if($('#disclaimer').prop("checked") == false){
               alert('Please agree disclaimer');
            }
    });
    var deadline = new Date("augest 27, 2020 09:27:25").getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var t = deadline - now;
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        document.getElementById("day").innerHTML = days;
        document.getElementById("hour").innerHTML = hours;
        document.getElementById("minute").innerHTML = minutes;
        document.getElementById("second").innerHTML = seconds;
        if (t < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "TIME UP";
            document.getElementById("day").innerHTML = '0';
            document.getElementById("hour").innerHTML = '0';
            document.getElementById("minute").innerHTML = '0';
            document.getElementById("second").innerHTML = '0';
            $('.quizbtn').css('display', 'block');
        }
    }, 1000);
    </script>

</body>

</html>