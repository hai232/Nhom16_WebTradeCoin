<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();
    if(strpos($_POST['amount'], ' ') !== false || strpos($_POST['amount'], '"') !== false || strpos($_POST['amount'], "'") !== false){
        echo json_encode(array(
            'status' => 500,
            'message' => "Failed"
        ));
        return;
    }
    //login.php TRUYỀN DỮ LIỆU SANG: NHẬN DỮ LIỆU TỪ login.php gửi sang
        $amount = $_POST['amount'];
        $email = $_SESSION['id'];
        $wallet = $_POST['wallet'];
        //Ở đây còn phải kiểm tra người dùng đã nhập chưa

        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }
        // Bước 02: Thực hiện truy vấn
        if($wallet == 'demo'){
        $sql = "SELECT * FROM demo_wallet WHERE email = '$email' AND coin='USD'";
        // Ở đây còn có các vấn đề về tính hợp lệ dữ liệu nhập vào FORM
        // Nghiêm trọng: lỗi SQL Injection

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) == 0){
            $sql ="INSERT INTO demo_wallet VALUES('$email' , 'USD' , '0')";
            mysqli_query($conn,$sql);
        };

        $sql ="UPDATE demo_wallet SET balance=balance+'$amount' WHERE email = '$email' AND coin='USD'";
        mysqli_query($conn,$sql);
        $sql = "SELECT balance FROM demo_wallet WHERE email = '$email' AND coin='USD'";
        $result = mysqli_query($conn,$sql);
        $balance =  $result->fetch_assoc()["balance"];
        echo json_encode(array(
            'status' => 500,
            'message' => $balance
        ));
        }
        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>