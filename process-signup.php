<?php
      session_start();
    //login.php TRUYỀN DỮ LIỆU SANG: NHẬN DỮ LIỆU TỪ login.php gửi sang
    if(isset($_POST['btnSignIn'])){
        if(strpos($_POST['email'], ' ') !== false || strpos($_POST['email'], '"') !== false || strpos($_POST['email'], "'") !== false){
            header("location:login.php");
        }
        if(strpos($_POST['pass'], ' ') !== false || strpos($_POST['pass'], '"') !== false || strpos($_POST['pass'], "'") !== false){
            header("location:login.php");
        }
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        //Ở đây còn phải kiểm tra người dùng đã nhập chưa

        $emailhash = "";
        for( $i=0 ; $i < strlen($email) ; $i++){
            $emailhash += ord($email[$i])
        }

        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }
        // Bước 02: Thực hiện truy vấn

        $sql = "INSERT INTO user(email, pass) VALUES('$email','$pass')";

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
        }else{
            $_SESSION['isLoginOK'] = $email;
            header("location: profile.php?error=$error"); //Chuyển hướng, hiển thị thông báo lỗi
        }

        // Bước 03: Đóng kết nối
        mysqli_close($conn);
    }else{
        header("location:login.php");
    }
?>
