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

        $sql = "SELECT * FROM user_trade WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $rows = [];
            while($row = mysqli_fetch_array($result))
            {
                $rows[] = $row;
            }
            echo json_encode(array(
                'status' => 500,
                'message' => $rows
            ));
        }else echo json_encode(array(
            'status' => 500,
            'message' => 0
        ));
        
        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>