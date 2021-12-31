<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();
    if(strpos($_POST['email'], ' ') !== false || strpos($_POST['email'], '"') !== false || strpos($_POST['email'], "'") !== false){
        echo json_encode(array(
            'status' => 500,
            'message' => "Bạn nhập thông tin Email hoặc mật khẩu chưa chính xác"
        ));
        return;
    }
    if(strpos($_POST['pass'], ' ') !== false || strpos($_POST['pass'], '"') !== false || strpos($_POST['pass'], "'") !== false){
        echo json_encode(array(
            'status' => 500,
            'message' => "Bạn nhập thông tin Email hoặc mật khẩu chưa chính xác"
        ));
        return;
    }
    //login.php TRUYỀN DỮ LIỆU SANG: NHẬN DỮ LIỆU TỪ login.php gửi sang
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        //Ở đây còn phải kiểm tra người dùng đã nhập chưa

        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }
        // Bước 02: Thực hiện truy vấn
        $sql = "SELECT * FROM user WHERE email = '$email' AND pass='$pass'";
        // Ở đây còn có các vấn đề về tính hợp lệ dữ liệu nhập vào FORM
        // Nghiêm trọng: lỗi SQL Injection

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            // CẤP THẺ LÀM VIỆC
            $_SESSION['id'] = $email;
            echo json_encode(array(
                'status' => 200,
                'message' => "Login Successful."
            ));
        }else{
            echo json_encode(array(
                'status' => 500,
                'message' => "Bạn nhập thông tin Email hoặc mật khẩu chưa chính xác"
            ));
        }

        // Bước 03: Đóng kết nối
        mysqli_close($conn);

?>
