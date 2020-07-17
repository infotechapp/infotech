
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
                <div class="row">
                    <div id="restable"> 
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
    //$('#result').click(function(){ 
      $(".loader2").css("display","block");
      $.ajax({
        type: "POST",
        url: "/liveinfotech/resultAjax.php",
        dataType: 'json',
        success: function (data){
          $(".loader2").css("display","none");
          html=""; 
          if(data){
              $("#restable").empty();
              html+='<table class="table table-striped table-bordered table-dark"><thead><tr><th scope="col">Image</th><th scope="col">Roll No</th><th scope="col">Name</th><th scope="col">Father Name</th><th scope="col">Address</th><th scope="col">Result</th><th scope="col">Time</th></tr></thead><tbody>'; 
              $.each(data, function (index, obj) {
             if(obj.img_name){
                  img_url = '<img src=http://infotechapp.com/images/student/'+ obj.img_name + ' width="100" height="110">';  
              }else{
                  img_url = '<img src=http://infotechapp.com/images/student/download.jpeg width="100" height="110">';   
              } 
                
                html += '<tr><td> ' + img_url + ' </td><td> ' + obj.roll_number + ' </td> <td> ' + obj.name + ' </td> <td>' + obj.father_name + '</td> <td>' + obj.address + '</td><td>' + obj.correct_answer+'/50' + '</td><td>' + obj.submitted_date + '</td> </tr>';
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
//});   
</script>