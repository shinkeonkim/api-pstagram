<?php
    header('Content-Type: application/json; charset=utf8');   
    include '../server_init.php';
    $flag = 1;
    $code = "";
    $error_number = -1;
    $data = file_get_contents('php://input');
    $arr = json_decode($data,true);

    $username = $arr['username'];
    $email = $arr['email'];
    $password = $arr['password'];

    $sql = "SELECT * FROM `user` WHERE email in ('{$email}');";
    $result = mysqli_query($conn,$sql);
    $row= mysqli_fetch_array($result);

    if(isset($row['email']))
    {   
        $flag=0;
        $error_number = 0;
    } 
    else 
    {
        $hash = hash("sha1",$password);
        $profile_url = "img/resources/avatar.png";
        $created_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `user` (`email`, `username`,`password`,`profile_url`,`created_at`) VALUES ('$email' , '$username','$hash','$profile_url','$created_at')";
        $result = mysqli_query($conn,$sql);
        
        if(!$result)
        {
            $flag=0;
            $error_number=1;
            echo mysqli_error($conn); //mysqli 쿼리문 에러 보기
        } 
    }

    if($flag == 0)
    {
        $code = "error";
        $error_msg = "error";
        if($error_number == 0)
        {
            $error_msg="같은 이메일이 존재합니다.";
        }
        else if($error_number == 1)
        {
            $error_msg="서버 오류가 발생했습니다. 관리자에게 문의해주세요.";
        }
        $data = array(
            'code' => $code,
            'msg' => $error_msg
        );
        echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));
    }
    else 
    {
        $code = "success";
        $success_msg = "회원가입이 완료되었습니다.";
        $sql = "SELECT * FROM `user` WHERE username in ('{$username}');";
        $result = mysqli_query($conn,$sql);
        $row= mysqli_fetch_array($result);
        
        $user_id = $row['user_id'];

        $data = array(
            'code' => $code,
            'msg' => $success_msg,
            'user_id' => $user_id, 
            'email' => $email, 
            'username' => $username,
            'profile_url' => $server_url.$profile_url,
            'created_at' => $created_at
        );
        echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));
       
    }

    mysqli_close($conn);
?>