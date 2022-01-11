<?php

$data = json_decode(file_get_contents('https://api.binance.com/api/v3/ticker/24hr?symbol='.'BNB'.'USDT'));
foreach($data as $key => $value) {
  if($key == "lastPrice")
  $price =  $value;
}
echo $price*4;

?>