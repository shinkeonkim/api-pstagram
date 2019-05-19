<!DOCTYPE html>
<html>
    <head> </head>

    <body>
        <?php
            if(isset($_GET['user_id']))
            {
                $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
                $user_id=$_GET['user_id'];
                $sql ="SELECT * FROM `user` WHERE user_id= {$_GET['user_id']};";
                $result = mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "lookup_error";
                    echo mysqli_error($conn);
                }

                $row = mysqli_fetch_array($result);
                $username=$row['username'];
                $email=$row['email'];
                $created_at=$row['created_at'];
                $profile_url=$row['profile_url'];
                

                $data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'username' => $username,
                    'profile_url' => $profile_url,
                    'created_at' => $created_at
                );
                
                echo json_encode($data);
                mysqli_close($conn);
            }
        ?> 
    </body>

</html>