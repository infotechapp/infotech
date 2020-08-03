<?php

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

  $sqlinner = "select id from questions where status = 1";
  $result2 = mysqli_query($conn, $sqlinner) or die(mysqli_error($conn));
  $number_question = mysqli_num_rows($result2);
  //print_r($number_question);die;

  $sql = "select result_date from common";
  $result3 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $row = mysqli_fetch_array($result3);
  $result_date = $row['result_date'];
  $datetime = date('Y-m-d H:i:s',strtotime($result_date));
  $todaydate = date("Y-m-d H:i:s");
  $timestampresult = strtotime($datetime);
  $timestamptoday = strtotime($todaydate);


?>

<style type="text/css">
    .subscribe input.form-control.result {
    border: 1px solid rgba(25, 19, 19, 0.35);
}
</style>
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
                    <h2>Result</h2>
                    <ul class="breadcrumb">
                        <li>Home</li>
                        <li><a href="javascript:void(0)">Result</a></li>
                    </ul>
                </div>
            </div><!-- Subpage title end -->
        </div><!-- Banner area end -->
        <!-- Main container start -->


        <section id="main-container">
            <div class="container">
                <div class="row resultTab" style="display: none">
                <div class="col-md-12">
                <form name="resultForm" action="result.php" id="resultForm" method="POST">
                        <div class="input-group subscribe">
                            <input type="text" class="form-control result" required="" name="roll_number" placeholder="Enter Roll Number">
                            <span class="input-group-addon">
                                <button class="btn" type="button" id="resultAction"><i class="fa fa-search"> </i></button>
                            </span>
                        </div>
                    </form>
                    <div id="restable">
                </div>
                </div>
                </div>


                <div class="row timerTab"  style="display: none;">
                    <div>
                        <div class="col-md-8">

                            <h3 class="title-border">Online Quiz Result</h3>

                            <p><strong>Infotechapp results 2020</strong></p>
                            <p><strong class="text-success">Published on <mark> 10.08.2020</mark></p>

                        </div><!--/ Col end -->

                        <div class="col-md-4">
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
                        </div>
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

<div class="loader2" style="display:none">
      <img src="/liveinfotech/images/ajax-loader.gif" alt="Loading...">
    </div>
</html>


<script type="text/javascript">
        var number_question = '<?php echo $number_question;?>';
        var result_date = '<?php echo $result_date;?>';
        var deadline = new Date(result_date).getTime();
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
            $(".timerTab").css("display","none");
            $(".resultTab").css("display","block");
            $("#resultAction").click();
        }
        else{
            $(".timerTab").css("display","block");
            $(".resultTab").css("display","none");
        }
       }, 1000);


    $("#resultAction").on("click", function(){
      $(".loader2").css("display","block");
      $.ajax({
        type: "POST",
        url: "/liveinfotech/resultAjax.php",
        data: $('#resultForm').serialize(),
        dataType: 'json',
        success: function (data){
          $("#restable").empty();
          $(".loader2").css("display","none");
          html="";
          if (data.length != 0) {

              html+='<table class="table table-striped table-bordered table-dark"><thead><tr><th scope="col">Rank</th><th scope="col">Image</th><th scope="col">Roll No</th><th scope="col">Name</th><th scope="col">Father Name</th><th scope="col">Address</th><th scope="col">Result</th><th scope="col">Time</th></tr></thead><tbody>';
              i = 0;
              $.each(data, function (index, obj) {
               if(i <= 2){
                  icon = '<i class="fa fa-trophy" style="color:#FFD700; font-size: 25px"; aria-hidden="true"></i>';
               }else{
                  icon = '';
               }
               if(obj.img_name){
                    img_url = '<img src=http://infotechapp.com/images/student/'+ obj.img_name + ' width="100" height="110">';
                }else{
                    img_url = '<img src=http://infotechapp.com/images/student/download.jpeg width="100" height="110">';
                }

                  html += '<tr><td> ' + obj.position + '  '+icon+' </td><td> ' + img_url + ' </td><td> ' + obj.roll_number + ' </td> <td> ' + obj.name + ' </td> <td>' + obj.father_name + '</td> <td>' + obj.address + '</td><td>' + obj.correct_answer+'/'+number_question+'</td><td>' + obj.submitted_date + '</td> </tr>';
                  i++;
              });
              html += '</tbody>';
              html += '</table>';
          }else{
              html +='No Result Found!';
          }

          $("#restable").append(html);
        },
        error: function(xhr, textStatus, error){
          console.log(xhr.statusText);
          console.log(textStatus);
          console.log(error);
        }
  });
   });

</script>