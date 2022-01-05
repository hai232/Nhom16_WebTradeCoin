coin_name="BTC";
function GetUserInfo(){
      $.ajax({
        url:"profile.php",
        type:"POST",
        data:{},
        success:function(data){
          data = JSON.parse(data)
          balance = data.message;
          $("#balance").text("$" + balance);
        }
    })
    }
    
    function UpdateMyTrade(){
      if(document.getElementById("MyTrade").style.display == "block"){
      $.ajax({
        url:"my_trade.php",
        type:"POST",
        data:{},
        success:function(data){
          data = JSON.parse(data)
          if(data.status == 200){
            location.reload();
          }
          if(data.status == 500){
            my_trade = data.message;
          }
          document.getElementById('table_trade').innerHTML = '';
          var table = document.getElementById("table_trade");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(-1);
            var cell2 = row.insertCell(-1);
            var cell3 = row.insertCell(-1);
            var cell8 = row.insertCell(-1);
            var cell4 = row.insertCell(-1);
            var cell5 = row.insertCell(-1);
            var cell6 = row.insertCell(-1);
            var cell7 = row.insertCell(-1);
            cell1.innerHTML = "Type";
            cell2.innerHTML = "Coin";
            cell3.innerHTML = "Amount";
            cell8.innerHTML = "Total";
            cell4.innerHTML = "Buy Price";
            cell5.innerHTML = "Current Price";
            cell6.innerHTML = "Profit/Loss";
            cell7.innerHTML = "Option";
            
          for (let i = 0; i < my_trade.length; i++) {
            if(my_trade[i].type == "sell"){
            profit =  Number(my_trade[i].balance *(my_trade[i].buy_price - coindata.find(x => x.symbol === my_trade[i].coin).lastPrice)).toLocaleString(undefined, {maximumSignificantDigits: 2})
            }else profit = -Number(my_trade[i].balance * (my_trade[i].buy_price - coindata.find(x => x.symbol === my_trade[i].coin).lastPrice)).toLocaleString(undefined, {maximumSignificantDigits: 2})
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(-1);
            var cell2 = row.insertCell(-1);
            var cell3 = row.insertCell(-1);
            var cell8 = row.insertCell(-1);
            var cell4 = row.insertCell(-1);
            var cell5 = row.insertCell(-1);
            var cell6 = row.insertCell(-1);
            var cell7 = row.insertCell(-1);
            if(my_trade[i].type == "sell"){
              cell1.innerHTML = '<div style="background-color: red;">'+my_trade[i].type+'</div>';
            }else cell1.innerHTML = '<div style="background-color: green;">'+my_trade[i].type+'</div>';
            
            cell2.innerHTML = my_trade[i].coin;
            cell3.innerHTML = Number(my_trade[i].balance).toLocaleString(undefined, {maximumSignificantDigits: 5});
            cell8.innerHTML = (Math.round(my_trade[i].balance * my_trade[i].buy_price *10) / 10 ) + Math.round(profit*1000)/1000;
            cell4.innerHTML = Number(my_trade[i].buy_price).toLocaleString(undefined, {maximumSignificantDigits: 5});
            cell5.innerHTML = Number(coindata.find(x => x.symbol === my_trade[i].coin).lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 5});
            if(profit >= 0 ){
              cell6.innerHTML = '<div style="color: green;">'+profit+'</div>';
            }else cell6.innerHTML = '<div style="color: red;">'+profit+'</div>';
            
            cell7.innerHTML = '<div style="background-color: rgb(92, 99, 0);cursor: pointer;" onclick = "StopTrade('+my_trade[i].trade_id+')">Stop</div>';
          }
        }
        })
      }
    }

    function StopTrade(id){
      console.log(id);
    }

  function UpdateTradeTable(){
      cointrading =  coindata.find(x => x.symbol === coin_name);
      $("#coin-name").text(coin_name);
      $("#coin-price").text(Number(cointrading.lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}));
  }

  function ShowTradeTable(coin){
    if(isLogin){
      coin_name = coin;
      cointrading =  coindata.find(x => x.symbol === coin);
      console.log(cointrading);
      $("#coin-name").text(coin);
      $("#coin-price").text(Number(cointrading.lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}));
      document.querySelector('tradepad').style = 'display: block';
    }else openForm();
    }
  function ShowMess(mess){
    $("#light").text(mess);
    document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';
  }
  
  function close_Mess(){
    if(document.getElementById('light').style.display =='block'){
    document.getElementById('light').style.display='none';
    }
    if(document.getElementById("MyTrade").style.display != 'block' && document.getElementById("LoginForm").style.display != 'block' && document.getElementById("SignupForm").style.display != 'block' && document.getElementById("DepositForm").style.display != 'block' ){
      document.getElementById('fade').style.display='none';
    }
  }
  
  function openMyTrade() {
    document.getElementById('fade').style.display='block';
    document.getElementById("MyTrade").style.display = "block";
    UpdateMyTrade();
  }

  
  function openForm() {
    document.getElementById('fade').style.display='block';
    document.getElementById("LoginForm").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById('fade').style.display='none';
    document.getElementById("LoginForm").style.display = "none";
    document.getElementById("DepositForm").style.display = "none";
    document.getElementById("SignupForm").style.display = "none";
    document.getElementById("MyTrade").style.display = "none";
    document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';
  }
  
  function openForm_signup() {
    document.getElementById('fade').style.display='block';
    document.getElementById("SignupForm").style.display = "block";
  }
  balance = 0;
  coindata = [];
  soft_type = 0;
  coin_recent = [];
  coinview = [];
  function softcoin(){
    coinlist = [];
    
    UpdateTradeTable()

    for(let i = 0 ; i  < coindata.length ; i ++){
      coinlist.push(coindata[i]);
    }
    document.getElementById('list').innerHTML = '';
                      tr = table.insertRow(-1)
                      cell1 = tr.insertCell(-1);
                      cell2 = tr.insertCell(-1);
                      cell3 = tr.insertCell(-1);  
                      cell4 = tr.insertCell(-1);
                      cell5 = tr.insertCell(0);
                      if(soft_type == 1 || soft_type ==2){
                      cell1.innerHTML = "<div style=' color:rgb(240, 185, 11)' onclick= 'soft_type != 1 ? soft_type != 2 ? soft_type = 1 : soft_type = 0 : soft_type = 2 ; softcoin()' >Name</div>";
                      }else cell1.innerHTML = "<div onclick= 'soft_type != 1 ? soft_type != 2 ? soft_type = 1 : soft_type = 0 : soft_type = 2 ; softcoin()' >Name</div>";
                      
                      if(soft_type == 3 || soft_type ==4){
                      cell2.innerHTML = "<div style='color:rgb(240, 185, 11)' onclick= 'soft_type != 4 ? soft_type != 3 ? soft_type = 4 : soft_type = 0 : soft_type = 3 ; softcoin()' >Price</div>";
                      }else  cell2.innerHTML = "<div onclick= 'soft_type != 4 ? soft_type != 3 ? soft_type = 4 : soft_type = 0 : soft_type = 3 ; softcoin()' >Price</div>";
                      
                      if(soft_type == 5 || soft_type ==6 || soft_type ==7){
                      cell3.innerHTML = "<div style='color:rgb(240, 185, 11)' onclick= 'soft_type != 5 ? soft_type != 6 ? soft_type != 7 ? soft_type = 5 : soft_type = 0 : soft_type = 7 : soft_type = 6 ; softcoin()' >24h Change</div>";
                      }else cell3.innerHTML = "<div onclick= 'soft_type != 5 ? soft_type != 6 ? soft_type != 7 ? soft_type = 5 : soft_type = 0 : soft_type = 7 : soft_type = 6 ; softcoin()' >24h Change</div>";
                      
                      if(soft_type == 8 || soft_type ==9 ){
                      cell4.innerHTML = "<div style='color:rgb(240, 185, 11)' onclick= 'soft_type != 9 ? soft_type != 8 ? soft_type = 9 : soft_type = 0 : soft_type = 8 ; softcoin()' >24h Volume</div>";
                      }else cell4.innerHTML = "<div onclick= 'soft_type != 9 ? soft_type != 8 ? soft_type = 9 : soft_type = 0 : soft_type = 8 ; softcoin()' >24h Volume</div>";

                      for(i=0 ; i < coinlist.length ; i++){
                          if(coin_recent.length == 0){
                            if(coinlist[i].priceChangePercent < 0){
                              coinlist[i].price_html ="<span style='color: red;'>"+Number(coinlist[i].lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}) + ' </span>' ;
                            }else coinlist[i].price_html = "<span style='color: #4ff03a;'>"+Number(coinlist[i].lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}) + ' </span>' ;
                          }else if(coinlist[i].lastPrice < coin_recent[i].lastPrice){
                              coinlist[i].price_html = "<span style='color: red;'>" + Number(coinlist[i].lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}) + '</span>';
                          }else if(coinlist[i].lastPrice > coin_recent[i].lastPrice){coinlist[i].price_html = "<span style='color: #4ff03a;'>" + Number(coinlist[i].lastPrice).toLocaleString(undefined, {maximumSignificantDigits: 15}) + '</span>';}
                          else coinlist[i].price_html = coin_recent[i].price_html;

                        ////////
                        if(coinlist[i].priceChangePercent < 0){
                          coinlist[i].priceChangePercent_html ="<span style='color: red;'>"+(Math.round(coinlist[i].priceChangePercent*100)/100).toFixed(2) + '% </span>' ;
                          }else coinlist[i].priceChangePercent_html = "<span style='color: #4ff03a;'>"+(Math.round(coinlist[i].priceChangePercent*100)/100).toFixed(2) + '% </span>' ;
                          
                          coinlist[i].quoteVolume_html =  "<span style='color: yellow'>" + '$' + (Number(coinlist[i].quoteVolume).toFixed(0)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "," );
                          
                          coinview[i] =coinlist[i];
                      }
                      
                    
                      coinlist=[];
  
                      switch(soft_type) {
                        //A>Z
                        case 1:
                          coinview.sort(function(a, b){
                            var aName = a.symbol.toLowerCase();
                            var bName = b.symbol.toLowerCase(); 
                            return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
                          })
                          break;
                        //Z>A
                        case 2:
                          coinview.sort(function(a, b){
                            var aName = a.symbol.toLowerCase();
                            var bName = b.symbol.toLowerCase(); 
                            return ((aName > bName) ? -1 : ((aName < bName) ? 1 : 0));
                          })
                          break;
                        //PriceLow
                        case 3:
                          coinview.sort(function(a, b) {
                              return parseFloat(a.lastPrice) - parseFloat(b.lastPrice);
                          });
                          break;
                        //PriceHight
                        case 4:
                          coinview.sort(function(b, a) {
                              return parseFloat(a.lastPrice) - parseFloat(b.lastPrice);
                          });
                          break;
                        //increase
                        case 5:
                          coinview.sort(function(b, a) {
                              return parseFloat(a.priceChangePercent) - parseFloat(b.priceChangePercent);
                          });
                          break;
                        //decrease
                        case 6:
                          coinview.sort(function(a, b) {
                              return parseFloat(a.priceChangePercent) - parseFloat(b.priceChangePercent);
                          });
                          break;
                        //highoscillate
                        case 7:
                          coinview.sort(function(b, a) {
                              return Math.abs(parseFloat(a.priceChangePercent)) - Math.abs(parseFloat(b.priceChangePercent));
                          });
                          break;
                          //highVolume
                        case 8:
                          coinview.sort(function(a, b){
                            return parseFloat(a.quoteVolume) - parseFloat(b.quoteVolume);
                          })
                          break;
                          //lowVolume
                        case 9:
                          coinview.sort(function(b, a){
                            return parseFloat(a.quoteVolume) - parseFloat(b.quoteVolume);
                          })
                          break;
  
                        default:
                          // code block
                      }
  
                      
                      
                        for(i=0 ; i < coinview.length ; i++){
                          if(coinview[i].symbol.includes($('#search').val().toUpperCase())){
                          tr = table.insertRow(-1)
                          cell1 = tr.insertCell(-1);
                          cell2 = tr.insertCell(-1);
                          cell3 = tr.insertCell(-1);
                          cell4 = tr.insertCell(-1);
                          cell5 = tr.insertCell(0);
                          cell1.innerHTML = coinview[i].symbol;
                          cell2.innerHTML = coinview[i].price_html;
                          cell3.innerHTML = coinview[i].priceChangePercent_html;
                          cell4.innerHTML = coinview[i].quoteVolume_html;
                          cell5.innerHTML = '<img style="border-radius: 15px" height="30px" width="30px" src=" images/'+coinview[i].symbol +'.svg"></img>';
                        }
                      }

  }
  
  function getcoin(){
    $.ajax({
                  url:"price.php",
                  type:"POST",
                  data:{},
                  success:function(data){ 
                    const vaaaa = JSON.parse(data)
                    coindata = [];
                    
                    for(i=0 ; i < vaaaa.length ; i++){
                          if(vaaaa[i].lastPrice != 0 && vaaaa[i].symbol.substr(vaaaa[i].symbol.length-4).includes("USDT")){
                            vaaaa[i].symbol = vaaaa[i].symbol.substr(0,vaaaa[i].symbol.length-4);
                            if(vaaaa[i].symbol.substr(vaaaa[i].symbol.length-2 ) != "UP"){
                            if(vaaaa[i].symbol.substr(vaaaa[i].symbol.length-4 ) != "DOWN"){
                              
                            coindata.push(vaaaa[i])}}
                          }
                      }

                      softcoin();
                      coin_recent=coindata;
                      $("#table tr").click(function() {
                        if($(this).children("td")[1].innerText != "Name"){
                      ShowTradeTable($(this).children("td")[1].innerText)}
                    
                    });
                  }  
              })
    
  }
  
  let emailPatern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
  $(document).ready(function(){
    GetUserInfo();
    getcoin();
    setInterval(getcoin , 4444);
    setInterval(UpdateMyTrade , 2222);
      
      

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
    
  
      $('#search').on('input', function() {
        softcoin();
      });
    
  

      $("#deposit").click(function(){
        document.getElementById('fade').style.display='block';
        document.getElementById("DepositForm").style.display = "block";
      })


      $("#btnDeposit").click(function(){
        if ($("#deposit_amount").val() == "" || Number($("#deposit_amount").val()) == NaN || Number($("#deposit_amount").val()) < 0) {return}
        if(Number($("#deposit_amount").val()) > 0){
          $.ajax({
            url:"deposit.php",
            type:"POST",
            data:{amount:Number($("#deposit_amount").val()) , wallet:$("#wallet").val()},
            success:function(data){
              data = JSON.parse(data)
              if(data.status == 200){
                location.reload();
              }
              if(data.status == 500){
                ShowMess("Deposit Success");
                balance = data.message;
                GetUserInfo();
              }
            }   
        })
        }
      })

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


      $("#long").click(function(){
        if ($("#amount").val() == "") {return}
        if(Number($("#amount").val()) > 0){
          $.ajax({
            url:"trade.php",
            type:"POST",
            data:{total:Number($("#amount").val()) , coin:coin_name , type:"buy"},
            success:function(data){
              data = JSON.parse(data)
              if(data.status == 200){
                location.reload();
              }
              if(data.status == 500){
                ShowMess(data.message);
                GetUserInfo();
              }
            }
        })
        }
      })

      $("#short").click(function(){
        if ($("#amount").val() == "") {return}
        if(Number($("#amount").val()) > 0){
          $.ajax({
            url:"trade.php",
            type:"POST",
            data:{total:Number($("#amount").val()) , coin:coin_name , type:"sell"},
            success:function(data){
              data = JSON.parse(data)
              if(data.status == 200){
                location.reload();
              }
              if(data.status == 500){
                ShowMess(data.message);
                GetUserInfo();
              }
            }
        })
        }
      })

      
  
  })
  

  
  