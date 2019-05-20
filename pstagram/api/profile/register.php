<!DOCTYPE html>
<html>
    <head> </head>

    <body> 
        <?php
            
            $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
            $arr=$_POST['register'];
            $username = $arr[0];
            $email = $arr[1];
            $password = $arr[2];
            
            $sql = "SELECT * FROM `user` WHERE email in ('{$email}');";
            $result = mysqli_query($conn,$sql);
            $row= mysqli_fetch_array($result);

            $sql2 = "SELECT * FROM `user` WHERE username in ('{$username}');";
            $result2 = mysqli_query($conn,$sql2);
            $row2= mysqli_fetch_array($result2);
            
            if(isset($row['email']))
            {
                echo "이메일이 중복됩니다.";
            }
            else if(isset($row2['username']))
            {
                echo "username이 중복됩니다.";
            }
            else 
            {
                
                $hash = hash("sha1",$password);
                $profile_url = "localhost/pstagram/img/resources/avatar.png";
                $created_at = date("Y-m-d H:i:s");
                $sql = "INSERT INTO `user` (`email`, `username`,`password`,`profile_url`,`created_at`) VALUES ('$email' , '$username','$hash','$profile_url','$created_at')";
                $result = mysqli_query($conn,$sql);
                
                if(!$result)
                {
                    echo "register_error";
                    echo mysqli_error($conn);
                }
                else 
                {
                    echo "register_success";
                }   
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
