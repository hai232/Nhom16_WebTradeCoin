<?php
header('Access-Control-Allow-Origin: *');
echo file_get_contents('https://api.binance.com/api/v3/ticker/24hr');
?>