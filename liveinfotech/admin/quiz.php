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
    <div id="page-wrapper">
        <div id="page-container" class="">
            <div id="main-container">
                <div class="header" id="myHeader">
                    <?php include('dashboard_header.php'); ?>
                    <div class="timer">
                    <span class="minutes">40 Minutes Timer: </span>
                    <span class="minutes" id="minute"></span>
                    <span class="seconds" id="second"></span>
                    </div>
                </div>
                <!-- <div id="clockdiv">
                    <div>
                        <span class="minutes" id="minute"></span>
                        <div class="smalltext">Minutes</div>
                    </div>
                    <div>
                        <span class="seconds" id="second"></span>
                        <div class="smalltext">Seconds</div>
                    </div>
                </div> -->
            </div>
            <div id="page-content" class="content" style="background-color: white;">
                <h3>Math online Quiz </h3>
                <form name="quizdash" id="quizdash" action="quiz.php">

                    Check the answer to each multiple-coice question, and click on the "Submit Quiz" button to
                    submit the
                    information.
                    <div id="questionData">
                    </div>
                    <br>
                    <br>
                    <input type="button" class="btn btn-lg btn-primary" value="Submit Quiz" id="quizsubmit">
                </form>
                <div class="loader2" style="display:none">
                    <img src="/liveinfotech/admin/img/ajax-loader.gif" alt="Loading...">
                </div>
            </div>
            <?php  include('footer.php');?>
        </div>
    </div>
    </div>
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php  include('common_js.php');?>
    <script>

    window.onscroll = function() {
        myFunction()
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
    </script>
    <script type="text/javascript">
    $(".loader2").css("display", "block");
    $.ajax({
        type: "POST",
        url: "ansAjax.php",
        dataType: 'json',
        success: function(data) {
            fullscreen()
            $('#questionData').empty();
            $(".loader2").css("display", "none");
            html = '';
            i = 1;
            $.each(data, function(index1, val1) {
                html += '<P>' + i + '. ' + val1.question + '<BR>';
                html += '<input type="hidden"  name="user_id" value=' + val1.user_id + '>';
                html += '<input type="hidden"  name="question_id[]' + i + '" value=' + val1
                    .question_id + '>';
                html += '<input type="radio" class="quizcheckbox" name="ans[]' + i + '" value=' +
                    val1.answers.ans1 + '>' + val1.answers.ans1 + '<BR>';
                html += '<input type="radio" class="quizcheckbox" name="ans[]' + i + '" value=' +
                    val1.answers.ans2 + '>' + val1.answers.ans2 + '<BR>';
                html += '<input type="radio" class="quizcheckbox" name="ans[]' + i + '" value=' +
                    val1.answers.ans3 + '>' + val1.answers.ans3 + '<BR>';
                html += '<input type="radio" class="quizcheckbox" name="ans[]' + i + '" value=' +
                    val1.answers.ans4 + '>' + val1.answers.ans4 + '<BR>';
                i++;
            });
            $('#questionData').html(html);
        },
        error: function(xhr, textStatus, error) {
            fullscreen()
        }
    });

    function fullscreen() {
        var elem = document.getElementById("page-wrapper");
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

    $('#quizsubmit').click(function() {
        if ($("input.quizcheckbox").filter(':checked').length < 1) {
            alert("Please attempt at least one Question!");
            return false;
        }
        $(".loader2").css("display", "block");
        $.ajax({
            type: "POST",
            url: "saveQuizAjax.php",
            data: $('#quizdash').serialize(),
            dataType: 'json',
            success: function(data) {
                if (data == 'Error') {
                    alert(
                        'Someone else is already logged on using this user ID. Please contact to the admin!');
                    window.location.href = "index.php?message=alreadyLogin";
                } else {
                    $(".loader2").css("display", "none");
                    alert(data);
                    window.location.href = "index.php";
                }
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
    });
    var deadline = new Date("july 27, 2020 09:44:25").getTime();
    var x = setInterval(function() {
        var now = new Date().getTime();
        var t = deadline - now;
        var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((t % (1000 * 60)) / 1000);
        document.getElementById("minute").innerHTML = minutes +'m : ';
        document.getElementById("second").innerHTML = seconds+'s';
        if (t < 0) {
            clearInterval(x);
            document.getElementById("minute").innerHTML = '0m : ';
            document.getElementById("second").innerHTML = '0s';
            $("#quizsubmit").click();
        }
    }, 1000);
    </script>
</body>