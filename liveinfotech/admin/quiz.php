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
<h3>Math online Quiz </h3>

<form name="quizdash" id="quizdash" >

Check the answer to each multiple-coice question, and click on the "Send Form" button to submit the information.
<div id="questionData">
</div>
<br>
<br>
<input type="submit" class="btn btn-primary" value="Submit Quiz" id="quizsubmit">
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
        $.each(data,function(index1, val1){
          html += '<P>'+val1.question+'<BR>';
          html += '<input type="hidden"  name="user_id" value='+val1.user_id+'>';
          html += '<input type="hidden"  name="question_id" value='+val1.question_id+'>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]" value='+val1.answers.ans1+'>'+val1.answers.ans1+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]" value='+val1.answers.ans2+'>'+val1.answers.ans2+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]" value='+val1.answers.ans3+'>'+val1.answers.ans3+'<BR>';
          html +='<input type="radio" class="quizcheckbox" name="ans[]" value='+val1.answers.ans4+'>'+val1.answers.ans4+'<BR>';
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
    success: function (json){
      $(".loader2").css("display","none");
      alert('Updated successfully.!');
    },
    error: function(xhr, textStatus, error){
      console.log(xhr.statusText);
      console.log(textStatus);
      console.log(error);
    }
  });
});    
 </script>