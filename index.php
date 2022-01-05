
<!DOCTYPE html>
<html lang="en">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="header-style.css">
    <link rel="stylesheet" href="form-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <header  >
    <div class="topnav">
  <a class="active" href="#home">Home</a>

      <input type="text" id='search' placeholder="Search.." name="search" class="search-container">


  <?php
  session_start();
  if(isset($_SESSION['id'])){
    echo '<script type="text/javascript">var isLogin = true</script>';
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

    echo '<a style=" cursor: pointer;" class="login" id = "balance" >
          $0
          </a>';

  }else{
    echo '<a href="#login" class="login" onclick="openForm()">Login</a>';
    echo '<a href="#signup" class="login" onclick="openForm_signup()">Sigup</a>';
    echo '<script type="text/javascript">var isLogin = false</script>';
  }
?>
    </header>
<body style="background-color: #111">
<br>
<br>
<br>
<div> </div>


<div id="mySidenav" class="sidenav">
  <a >All</a>
  <a >Favorite</a>
  <a onclick="openMyTrade();">My Trade</a>
</div>

  <table class="coin_view"  id = 'table' >
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

  <div class="form-mytrade" id="MyTrade">
  <div class="form-container">
    <h1>My Trade</h1>
    <div class="wrap">
    <div class="scroll-table">
      <table class= 'table_trade' >
      <!-- Put <thead>, <tbody>, and <tr>'s here! -->
      <colgroup>
        <col span="1" style="width: 7%;">
        <col span="1" style="width: 14%;">
        <col span="1" style="width: 14%;">
        <col span="1" style="width: 14%;">
        <col span="1" style="width: 14%;">
        <col span="1" style="width: 14%;">
        <col span="1" style="width: 15%;">
        <col span="1" style="width: 10%;">
      </colgroup>
      <tbody id = 'table_trade'>
      
      </tbody>
      </table>
  </div>
  </div>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
</div>
</div>



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
  <a  style = " cursor: pointer; width: 30px; position: absolute; right: 2px; top:10px;" onclick= "document.querySelector('tradepad').style = 'display: none'";><img style = "left:0px" width="20px" src="images/close.png"></div>   </a>
  <form onsubmit="return false" class="form-trade">
    <h1 >
    <a  style = " color:white; width: 30px; position: absolute;top:0px; left: 10px;">
      <div id = "coin-name"></div>
    </a>
    <a style = " color:white;" id = "coin-price"></a>
    </h1>
    <div style="  margin: auto;width: 50%;padding: 10px;" >
      <div  style="display: table-cell">
        <label><b>Amount</b></label>
        <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" placeholder="USD" name="pass" id="amount" required>
      </div>
      <div  style="display: table-cell">
        <label><b>Total</b></label>
        <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="text" placeholder="USD" name="pass"  required>
      </div>
    </div>
    <div>
      <button type="submit" class="btn" id = "long">Buy</button>
      <button type="button" class="btn cancel"  id="short" >Sell</button>
    </div>
  </form>
</tradepad>
</html>