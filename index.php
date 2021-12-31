
<!DOCTYPE html>
<html lang="en">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="header-style.css">
    <link rel="stylesheet" href="login-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <header  >
    <div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>

      <input type="text" placeholder="Search.." name="search" class="search-container">


  <?php
  session_start();
  if(isset($_SESSION['id'])){
    echo '<a1 href="#" class="login" style=" display: flex;justify-content: center;align-items: center;overflow: hidden; width: 50px;;height: 50px;" >
    <a2 class="drop" style=" display: flex;justify-content: center;align-items: center;overflow: hidden; width: 50px;;height: 50px; ><a href="#">
    <img src="images/user_icon.png" style="width: 50px;height: 50px;"></a>
    <ul1 class="dropdown" >
      <a  href="#" style="width: 100px;height: 50px;" >Profile</a>
      <a  href="#" style="width: 100px;height: 50px;" >Setting</a>
      <a id = "logout" href="#" style="width: 100px;height: 50px;" > Log Out</a>
    </ul1>
  </li>
     </a1>';
    echo '<a class="login">'.$_SESSION['id']."</a>";
  }else{
    echo '<a href="#login" class="login" onclick="openForm()">Login</a>';
    echo '<a href="#signup" class="login" onclick="openForm_signup()">Sigup</a>';
  }
?>
    </header>
<body style="background-color: #e9e9e9">
<br>
<br>
<br>


  <table style="width: 100%" id = 'table'>
    <colgroup>
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 70%;">
       <col span="1" style="width: 15%;">
    </colgroup>
    
    
    
    <!-- Put <thead>, <tbody>, and <tr>'s here! -->
    <tbody id = 'list'>
        
    </tbody>
</table>

  <div id="light" class="white_content"><a>This is the lightbox content. </a><a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
  </div>
  <div id="fade" class="black_overlay" onclick="close_Mess()"></div>



<div class="form-popup" id="LoginForm">
  <form onsubmit="return false" class="form-container">
    <h1>Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Email" name="email" id="log_email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="********" name="pass"  id="log_pass" required>
    <input type="checkbox" value="remember-me"> Remember me
    <button type="submit" name="btnSignIn" class="btn" id = "btnSignIn">Login</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<div class="form-popup" id="SignupForm">
  <form onsubmit="return false" class="form-container">
    <h1>Sign Up</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Email" name="email" id="reg_email" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="********" name="pass" id="reg_pass" required>
    <label for="psw"><b>Confirm Password</b></label>
    <input type="password" placeholder="********" name="retype-pass" id="retype-pass" required>
    <input type="checkbox" value="remember-me"> Remember me
    <button type="" name="btnSignIn" class="btn" id = "btnSignUp" >Sign_up</button>
    <button type="button" class="btn cancel" onclick="closeForm_signup()">Close</button>
  </form>
</div>

<script>

function ShowTradeTable(coin){
  $("#trade").text(coin);
  document.querySelector('footer').style = 'display: block';
}
function ShowMess(mess){
  $("#light").text(mess);
  document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';
}

function close_Mess(){
  if(document.getElementById('light').style.display =='block'){
  document.getElementById('light').style.display='none';
  }
  if(document.getElementById("LoginForm").style.display == 'none' && document.getElementById("SignupForm").style.display == 'none' ){
    document.getElementById('fade').style.display='none';
  }
}


function openForm() {
  document.getElementById('fade').style.display='block';
  document.getElementById("LoginForm").style.display = "block";
}

function closeForm() {
  document.getElementById('fade').style.display='none';
  document.getElementById("LoginForm").style.display = "none";
}

function openForm_signup() {
  document.getElementById('fade').style.display='block';
  document.getElementById("SignupForm").style.display = "block";
}

function closeForm_signup() {
  document.getElementById('fade').style.display='none';
  document.getElementById("SignupForm").style.display = "none";
}

function getcoin(){
  $.ajax({
                url:"price.php",
                type:"POST",
                data:{},
                success:function(data){ 
                  vaaaa = JSON.parse(data)
                  coinlist = [];
                  for(i=0 ; i < vaaaa.length ; i++){
                        if(vaaaa[i].symbol.substr(vaaaa[i].symbol.length-4).includes("USDT")){
                          coinlist.push(vaaaa[i])
                        }
                    }
                    document.getElementById('list').innerHTML = '';
                    tr = table.insertRow(-1)
                    cell1 = tr.insertCell(-1);
                    cell2 = tr.insertCell(-1);
                    cell3 = tr.insertCell(-1);
                    cell1.innerHTML = 'Name';
                    cell2.innerHTML = 'price';
                    cell3.innerHTML = "NEW CELL1";
                    for(i=0 ; i < coinlist.length ; i++){
                    tr = table.insertRow(-1)
                    cell1 = tr.insertCell(-1);
                    cell2 = tr.insertCell(-1);
                    cell3 = tr.insertCell(-1);
                    cell1.innerHTML = coinlist[i].symbol;
                    cell2.innerHTML = Number(coinlist[i].price);
                    cell3.innerHTML = "NEW CELL1";
                    }
                    $("#table tr").click(function() {

                    ShowTradeTable($(this).children("td").html())

});
                }  
            })
  
}

let emailPatern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

$(document).ready(function(){
  getcoin();
  setInterval(getcoin, 1000000);

    $("#btnSignUp").click(function(){
      if ($("#reg_email").val() == "" || $("#reg_pass").val() == "" || $("#retype-pass").val() == "") {return}
      if ($("#reg_pass").val() !==  $("#retype-pass").val()) {
        ShowMess("Password not matching")
      } else if(emailPatern.test($("#reg_email").val()) == false){
        ShowMess("Invalid Email Address Format")
        }else{
          $.ajax({
                url:"process_signup.php",
                type:"POST",
                data:{email:$("#reg_email").val() , name:"" , pass:$("#reg_pass").val()},
                success:function(data){ 
                  data = JSON.parse(data)
                  if(data.status == 200){
                    location.reload();
                  }
                  if(data.status == 500){
                    ShowMess(data.message);
                  } 
                }   
            })
        }
    })


    $("#btnSignIn").click(function(){
      if ($("#log_email").val() == "" || $("#log_pass").val() == "") {return}
      if(emailPatern.test($("#log_email").val()) == false){
        ShowMess("Invalid Email Address Format")
        }else{
          $.ajax({
                url:"process_login.php",
                type:"POST",
                data:{email:$("#log_email").val() , name:"" , pass:$("#log_pass").val()},
                success:function(data){ 
                  data = JSON.parse(data)
                  if(data.status == 200){
                    location.reload();
                  }
                  if(data.status == 500){
                    ShowMess(data.message);
                  } 
                }  
            })
        }
    })

})

$("#logout").click(function() {
  $.ajax({
                url:"logout.php",
                type:"POST",
                data:{},
                success:function(data){
                  location.reload();
                }  
            })
});

$(".drop")
  .mouseover(function() {
  $(".dropdown").show(0);
});
$(".drop")
  .mouseleave(function() {
  $(".dropdown").hide(0);     
});



</script>


</body>
<footer>
  <div id='trade'>
    asdsadasd
  </div>
</footer>
</html>
