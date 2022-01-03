
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

      <input type="text" id='search' placeholder="Search.." name="search" class="search-container">


  <?php
  session_start();
  if(isset($_SESSION['id'])){
    echo '<a1 href="#" class="login" style=" display: flex;justify-content: center;align-items: center;overflow: hidden; width: 50px;;height: 50px;" >
    <a2 class="drop" style=" display: flex;justify-content: center;align-items: center;overflow: hidden; width: 50px;;height: 50px; ><a href="#">
    <img src="images/user_icon.png" style="width: 50px;height: 50px;"></a>
    <ul1 class="dropdown" >
      <a  style=" cursor: pointer; width: 100px;height: 50px;" >Profile</a>
      <a  style=" cursor: pointer;  width: 100px;height: 50px;" >Setting</a>
      <a id = "logout" href="#" style="width: 100px;height: 50px;" > Log Out</a>
    </ul1>
  </li>
     </a1>';

    echo '<a style=" cursor: pointer;" class="login" id = "deposit" >
          Deposit
        </a>';

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
<div> </div>

  <table  id = 'table'>
    <colgroup>
      <col span="1" style="width: 0%;">
       <col span="1" style="width: 10%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 60%;">
       <col span="1" style="width: 0%;">
    </colgroup>
    
    
    
    <!-- Put <thead>, <tbody>, and <tr>'s here! -->
    <tbody id = 'list'>
        
    </tbody>
</table>

  <div id="light" class="white_content"><a>message. </a><a href="javascript:void(0)" onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
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



<div class="form-popup" id="DepositForm">
  <form onsubmit="return false" class="form-container">
    <h1>Deposit</h1>

    <select name="wallet" id="wallet" style="width : 100% ; height:30px;line-height:30px;">
      <option value="demo">Demo</option>
      <option value="live">Live</option>
  </select>

    <label for="psw"><b>Amount</b></label>
    <input type="text" placeholder="USD" name="pass"  id="deposit_amount" required>
    <button type="submit" name="btnSignIn" class="btn" id = "btnDeposit">Deposit</button>
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
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script src='javascript.js'></script>


</body>
<tradepad  >
  <a  style = " cursor: pointer; width: 30px; position: absolute; right: 0px;" onclick= "document.querySelector('tradepad').style = 'display: none'";><img style = "left:0px" width="20px" src="images/close.png"></div>
  <div id='trade'>
    
</a>
</tradepad>
</html>
