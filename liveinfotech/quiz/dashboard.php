<?php
ob_start();
session_start();
include 'function/database.php';
include('check_token.php');
if(empty($_SESSION['login_id'])){       header('Location: http://infotechapp.com');     ob_end_flush();
    }

$sqlinner = "select exam_date,result_date from common";
$result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result2);
$exam_date = $row['exam_date'];
$result_date = $row['result_date'];
$datetimeresult = date('d-m-Y H:i:s',strtotime($result_date));

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

                <div class="custom-alert startbutton" style="display: none">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <p> Your quiz start now please click on "Start Quiz Button"</p>
                    </div>
                </div>

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
                            <li>
                                <h4>1. 1st 3 Winners will get Prize. (
                                    प्रथम 3 विजेताओं को मिलेगा पुरस्कार)</h4>
                            </li>
                            <li>
                                <h4>2. Read carefully the instructions before starting the exam. (परीक्षा शुरू करने से
                                    पहले निर्देशों को ध्यान से पढ़ें)</h4>
                            </li>
                            <li>
                                <h4>3. You have 50 minutes to complete the exam. (परीक्षा को पूरा करने के लिए आपके पास 50 मिनट हैं)</h4>
                            </li>
                            <li>
                                <h4>4. The exam contains a total of 50 questions. (परीक्षा पूरा करने के लिए आपके पास 50
                                    प्रश्न हैं)</h4>
                            </li>
                            <li>
                                <h4>5. There is only one correct answer to each question. Click on the most appropriate
                                    option to mark it as your answer. (
                                    प्रत्येक प्रश्न का केवल एक सही उत्तर है। अपने उत्तर के रूप में चिह्नित करने के लिए
                                    सबसे उपयुक्त विकल्प पर क्लिक करें)</h4>
                            </li>
                            <li>
                                <h4>6. You will be awarded 1 marks for each correct answer. (आपको प्रत्येक सही उत्तर के लिए 1 अंक प्रदान किया जाएगा)</h4>
                            </li>
                            <li>
                                <h4>7. There is no negative marks for each wrong answer. (आपको प्रत्येक सही उत्तर के लिए
                                    1 अंक प्रदान किया जाएगा)</h4>
                            </li>
                            <li>
                                <h4>8. A Number list of all questions appears at the center of the window. (विंडो के
                                    केंद्र में सभी प्रश्नों की एक संख्या सूची दिखाई देती है)</h4>
                            </li>
                            <li>
                                <h4>9. You can use plain paper while taking the exam. Do not use calculators, log tables, dictionaries, or any other printed/online reference material during the exam. (
                                    परीक्षा देते समय आप सादे कागज का उपयोग कर सकते हैं। परीक्षा के दौरान कैलकुलेटर, लॉग टेबल, शब्दकोश, या किसी अन्य मुद्रित / ऑनलाइन संदर्भ सामग्री का उपयोग न करें)</h4>
                            </li>
                            <li>
                                <h4>10. Do not click the button "End TEST" before completing the exam. A exam once
                                    submitted cannot be resumed. (परीक्षा पूरा करने से पहले बटन "एंड टेस्ट" पर क्लिक न
                                    करें। एक बार प्रस्तुत किया गया परीक्षा फिर से शुरू नहीं किया जा सकता है)</h4>
                            </li>
                            <li>
                                <h4>11. Once clicked on the (End TEST) button, You Cannot restart this exam. (एक बार (एंड टेस्ट) बटन पर क्लिक करने के बाद, आप इस परीक्षा को पुनः आरंभ नहीं कर सकते)</h4>
                            </li>
                            <li>
                                <h4>12. After completing the exam, You can see your result sheet on mention date at
                                    <?php echo $datetimeresult;?> (http://www.infotechapp.com/result.php). (परीक्षा पूरी करने के बाद, आप
                                    <?php echo $datetimeresult;?> (http://www.infotechapp.com/result.php) पर अपनी रिजल्ट शीट देख सकते हैं।)
                                </h4>
                            </li>
                            <li>
                                <h4>13. After Completing the exam Please logout your account for security purpose.
                                    (परीक्षा पूरा करने के बाद कृपया सुरक्षा उद्देश्य के लिए अपना खाता लॉगआउट करें)</h4>
                            </li>
                            <li>
                                <h4>14. During the eaxam, Do not refresh the Quiz page. (एक्जाम के दौरान क्विज पेज को
                                    रिफ्रेश न करें)</h4>
                            </li>
                            <li>
                                <h4>15. After time up, Exam will be auto-submitted. (टाइम-अप के बाद, एग्जाम ऑटो-सबमिट
                                    किया जाएगा)</h4>
                            </li>
                        </ul>
                        <label class="text-info disclaimer">
                            <input type="checkbox" id='disclaimer'>
                            I have read and understood all the instructions. I agree with all above given instructions.
                            <span></span>
                        </label>
                    </div>

                    <!-- END Key Features -->
                    <div class="quizbtn">
                        <!--     <a href="javascript:void(0)" class="btn btn-lg btn-primary quiz quizSubmitbut" disabled='disabled'><i class="fa fa-floppy-o"></i>
                            Start Quiz</a> -->
                        <button type="button" class="btn btn-lg btn-primary quiz quizSubmitbut" disabled><i
                                class="fa fa-floppy-o"></i>Start Quiz</button>
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
        if ($('#disclaimer').prop("checked") == true) {
            window.open("quiz.php", "_blank",
                "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=4000,height=4000");
        } else if ($('#disclaimer').prop("checked") == false) {
            alert('Please agree disclaimer');
        }
    });


    var exam_date = '<?php echo $exam_date;?>';
    var deadline = new Date(exam_date).getTime();
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
            $('.quizSubmitbut').removeAttr("disabled");
            $("#clockdiv").css("display", "none");
            $(".startbutton").css("display", "block");
        }
    }, 1000);
    </script>

</body>

</html>