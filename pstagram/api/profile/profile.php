<?php
    header('Content-Type: application/json; charset=utf8');
    include '../server_init.php';
    if(isset($_GET['user_id']))
    {    
        $user_id=$_GET['user_id'];
        $sql ="SELECT * FROM `user` WHERE user_id= '{$user_id}';";
        $result = mysqli_query($conn,$sql);
        if(!$result)
        {
            $data = array(
                'code' => "error",
                'msg' => "조회중 오류가 발생했습니다."
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            //echo mysqli_error($conn);
        }
        else 
        {
            $row = mysqli_fetch_array($result);
            $username=$row['username'];
            $email=$row['email'];
            $created_at=$row['created_at'];
            $profile_url=$row['profile_url'];
            if($email == NULL)
            {
                $data = array(
                    'code' => "error",
                    'msg' => "존재하지 않는 사용자입니다."
                );
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            else 
            {
                $data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'username' => $username,
                    'profile_url' => $server_url.$profile_url,
                    'created_at' => $created_at
                );    
                echo json_encode($data,JSON_UNESCAPED_UNICODE);  
            }   
        }
    }
    mysqli_close($conn);
?>