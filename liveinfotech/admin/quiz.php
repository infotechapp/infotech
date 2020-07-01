<?php 
ob_start();
session_start();
if(empty($_SESSION['login_id'])){       header('Location: https://infotechapp.com');     ob_end_flush();
    }

?>
<style type="text/css">
  .loader2 { margin: 40% 0 33% -20%;
position: absolute;
z-index: 9999;      
    width: 100%;    
    text-align: center;   
    top: 0;
    

}

.loader2  > img {
    margin-top: -50px;
    position: absolute;
    top: 50%;
}
.loader2 {
    margin: 0;
    position: fixed;
    z-index: 9999;
    width: 100%;
    text-align: center;
    top: 0;
    background: rgba(0,0,0,0.2);
    left: 0;
    height: 100%;
}
.loader2 > img {
    margin-top: -50px;
    position: absolute;
    top: 20%;
    left: 50%;
    margin-left: -50px;
}
</style>
<style> 


#clockdiv {
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    font-size: 13px;
    margin-right: 80px inherit;
    margin-top: -31px;
    margin-left: 900px;
}
#clockdiv > div{ 
    padding: 10px; 
    border-radius: 3px; 
    background: #00BF96; 
    display: inline-block; 
} 
#clockdiv div > span{ 
    padding: 15px; 
    border-radius: 3px; 
    background: #00816A; 
    display: inline-block; 
} 
.smalltext{ 
    padding-top: 5px; 
    font-size: 16px; 
} 
</style>
 <h1 class="heading">Countdown Clock</h1> 
                        <div id="clockdiv"> 
                          
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


<h3>Math online Quiz </h3>
<a href="logout.php" id="logoutclick"><i class="fa fa-ban fa-fw pull-right"></i></a>
<form name="quizdash" id="quizdash" action="quiz.php">

Check the answer to each multiple-coice question, and click on the "Submit Quiz" button to submit the information.
<div id="questionData">
</div>
<br>
<br>
<input type="button" class="btn btn-primary" value="Submit Quiz" id="quizsubmit">
</form>
<div class="loader2" style="display:none">
      <img src="/liveinfotech/admin/img/ajax-loader.gif" alt="Loading...">
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(".loader2").css("display","block");
    $.ajax({
      type: "POST",
      url: "/liveinfotech/admin/ansAjax.php",
      dataType: 'json',
      success: function (data){
        $('#questionData').empty();  
        $(".loader2").css("display","none");  
        html = '';    
        i = 1;
        $.each(data,function(index1, val1){
          html += '<P>'+i+'. '+val1.question+'<BR>';
          html += '<input type="hidden"  name="user_id" value='+val1.user_id+'>';
          html += '<input type="hidden"  name="question_id[]'+i+'" value='+val1.question_id+'>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]'+i+'" value='+val1.answers.ans1+'>'+val1.answers.ans1+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]'+i+'" value='+val1.answers.ans2+'>'+val1.answers.ans2+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]'+i+'" value='+val1.answers.ans3+'>'+val1.answers.ans3+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]'+i+'" value='+val1.answers.ans4+'>'+val1.answers.ans4+'<BR>';
          i++;
        });
        $('#questionData').html(html); 
      }
     }); 
$('#quizsubmit').click(function(){
  if ($("input.quizcheckbox"). filter(':checked'). length < 1){
    alert("Please attempt at least one Question!");
    return false;
  }
  $(".loader2").css("display","block");
  $.ajax({
    type: "POST",
    url: "/liveinfotech/admin/saveQuizAjax.php",
    data: $('#quizdash').serialize(),
    dataType: 'json',
    success: function (data){
      $(".loader2").css("display","none");
      //sessionStorage.clear();
      alert(data);
      window.location.href = "/liveinfotech/admin/logout_redirect.php";
    },
    error: function(xhr, textStatus, error){
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
  document.getElementById("minute").innerHTML = minutes;  
  document.getElementById("second").innerHTML =seconds;  
  if (t < 0) { 
          clearInterval(x); 
          document.getElementById("minute").innerHTML ='0' ; 
          document.getElementById("second").innerHTML = '0'; 

          $("#quizsubmit").click();

         
          
      } 
  }, 1000); 


 </script>