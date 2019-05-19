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
            mysqli_close($conn);
        ?>
    </body>
</html>
