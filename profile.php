<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();
        $email = $_SESSION['id'];
        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }
        // Bước 02: Thực hiện truy vấn

        $sql = "SELECT balance FROM demo_wallet WHERE email = '$email' AND coin='USD'";
        $result = mysqli_query($conn,$sql);
        $balance =  $result->fetch_assoc()["balance"];
        echo json_encode(array(
            'status' => 500,
            'message' => "'$balance'"
        ));

        
        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>