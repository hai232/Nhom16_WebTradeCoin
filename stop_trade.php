<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();

    if(strpos($_POST['trade_id'], ' ') !== false || strpos($_POST['trade_id'], '"') !== false || strpos($_POST['trade_id'], "'") !== false){
        echo json_encode(array(
            'status' => 500,
            'message' => "Failed"
        ));
        return;
    }

        $id = $_POST['trade_id'];
        $email = $_SESSION['id'];


        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }

        $sql = "SELECT * FROM user_trade WHERE email = '$email' AND trade_id='$id'";
        $result = mysqli_query($conn,$sql);
        $result =  $result->fetch_assoc();
        $coin =  $result["coin"];
        $balance =  $result["balance"];
        $type =  $result["type"];
        $buy_price =  $result["buy_price"];

        $data = json_decode(file_get_contents('https://api.binance.com/api/v3/ticker/24hr?symbol='.$coin.'USDT'));
        foreach($data as $key => $value) {
        if($key == "lastPrice")
        $price =  $value;
        }

        if($type == 'buy'){
            $monney = $price * $balance;
        }else if($type == 'sell'){
            $monney = ($buy_price*2 - $price) * $balance;
        }

        $sql = "DELETE FROM user_trade WHERE user_trade.trade_id = '$id'";
        mysqli_query($conn,$sql);
        $sql ="UPDATE demo_wallet SET balance=balance+'$monney' WHERE email = '$email' AND coin='USD'";
        mysqli_query($conn,$sql);

        echo json_encode(array(
            'status' => 500,
            'message' => "Success"
        ));

        // $sql = "SELECT * FROM demo_wallet WHERE coin = 'USD' AND email = '$email' AND balance >= '$total'";
        // $result = mysqli_query($conn,$sql);
        // if(mysqli_num_rows($result) > 0){
        //     $sql ="UPDATE demo_wallet SET balance=balance-'$total' WHERE email = '$email' AND coin='USD'";
        //     mysqli_query($conn,$sql);
        //     $sql ="INSERT INTO user_trade(email,coin,type,buy_price,balance) VALUES('$email','$coin','$type_trade','$price','$amount' )";
        //     mysqli_query($conn,$sql);

        //     echo json_encode(array(
        //         'status' => 500,
        //         'message' => "successfully purchase ".number_format($amount, 4, '.', '')." ".$coin
        //     ));
        // }else echo json_encode(array(
        //     'status' => 500,
        //     'message' => "not enough balance"
        //     ));

        

        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>