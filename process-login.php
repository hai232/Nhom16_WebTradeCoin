<?php
    // Tạo SESSION: mặc định mỗi phiên làm việc có thời hạn 24phut
    session_start();

    //login.php TRUYỀN DỮ LIỆU SANG: NHẬN DỮ LIỆU TỪ login.php gửi sang
    if(isset($_POST['btnSignIn'])){
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        //Ở đây còn phải kiểm tra người dùng đã nhập chưa

        // Bước 01: Kết nối Database Server
        $conn = mysqli_connect('localhost','root','','btl');
        if(!$conn){
            die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
        }
        // Bước 02: Thực hiện truy vấn
        $sql = "SELECT * FROM user WHERE email = ? OR nickname=?";
        // Ở đây còn có các vấn đề về tính hợp lệ dữ liệu nhập vào FORM
        // Nghiêm trọng: lỗi SQL Injection

        $stmt = mysqli_prepare($conn, $sql);
        $user = $email;
        mysqli_stmt_bind_param($stmt, "ss", $email, $user);

        
        if(mysqli_stmt_execute($stmt)){
            
            mysqli_stmt_bind_result($stmt, $mand, $tennd, $emailnd, $matkhaund);
            echo $mand;
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($pass, $matkhaund)){
                    $_SESSION['isLoginOK'] = $email;
                    //header("location: admin.php");
                }else{
                    $error = "Mật khẩu không chính xác";
                    //header("location: index.php?error=$error");
                }
            }else echo "Email khong ton tai";
        }


        // Bước 03: Đóng kết nối
        mysqli_close($conn);
    }else{
        header("location:login.php");
    }
?>
