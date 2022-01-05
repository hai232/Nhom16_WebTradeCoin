<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();

    if(strpos($_POST['total'], ' ') !== false || strpos($_POST['total'], '"') !== false || strpos($_POST['total'], "'") !== false){
        echo json_encode(array(
            'status' => 500,
            'message' => "Failed"
        ));
        return;
    }

        $total = $_POST['total'];
        $email = $_SESSION['id'];
        $coin = $_POST['coin'];
        $type_trade = $_POST['type'];

        $data = json_decode(file_get_contents('https://api.binance.com/api/v3/ticker/24hr?symbol='.$coin.'USDT'));
        foreach($data as $key => $value) {
        if($key == "lastPrice")
        $price =  $value;
        }

        $amount = $total / $price;

        //Ở đây còn phải kiểm tra người dùng đã nhập chưa

        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }



        $sql = "SELECT * FROM demo_wallet WHERE coin = 'USD' AND email = '$email' AND balance >= '$total'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $sql ="UPDATE demo_wallet SET balance=balance-'$total' WHERE email = '$email' AND coin='USD'";
            mysqli_query($conn,$sql);
            $sql ="INSERT INTO user_trade(email,coin,type,buy_price,balance) VALUES('$email','$coin','$type_trade','$price','$amount' )";
            mysqli_query($conn,$sql);

            echo json_encode(array(
                'status' => 500,
                'message' => "successfully purchase ".number_format($amount, 4, '.', '')." ".$coin
            ));
        }else echo json_encode(array(
            'status' => 500,
            'message' => "not enough balance"
            ));

        
        
        // Ở đây còn có các vấn đề về tính hợp lệ dữ liệu nhập vào FORM
        // Nghiêm trọng: lỗi SQL Injection

        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>