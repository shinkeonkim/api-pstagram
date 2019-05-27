<?php
    $flag = 1;
    $error_number=-1;
    $code = "";
    $error_msg ="";

    $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hash=hash("sha1",$password);
    $sql="SELECT * from `user` where email= '{$email}';";
    $result = mysqli_query($conn,$sql);

    if(!$result)
    {
        $flag = 0;
        $error_number = 0;
        // echo mysqli_error($conn);
    }
    else 
    {
        $row = mysqli_fetch_array($result);
        $user_id=$row['user_id'];
        $username=$row['username'];
        $email=$row['email'];
        $created_at=$row['created_at'];
        $profile_url=$row['profile_url'];
        
        if($row['password'] == $hash)
        {    
            $flag=1;   
            $code="success";
        }
        else 
        {
            $flag=0;
            if(isset($row['username']))
            {
                $error_number=1;
            }
            else
            {
                $error_number=2;
            }
        }
    }
    if($flag == 1)
    {
        $data = array(
            'code' => $code,
            'user_id' => $user_id,
            'email' => $email,
            'username' => $username,
            'profile_url' => $profile_url,
            'created_at' => $created_at
        );
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    else if($flag == 0)
    {
        $code = "error";
        if($error_number == 0)
        {
            $error_msg = "서버 오류가 발생했습니다. 관리자에게 문의해주세요.";
        }
        else if($error_number == 1)
        {
            $error_msg = "존재하지 않는 사용자/이메일입니다.";
        }
        else if($error_number ==2)
        {
            $error_msg = "비밀번호가 잘못 되었습니다.";
        }
        $data = array(
            'code' => $code,
            'msg' => $error_msg
        );  
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    mysqli_close($conn); 
?>