<!DOCTYPE html>
<html>
    <head> </head>

    <body> 
        <?php
            
            $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
            $arr = $_POST['login'];
            $email=$arr[0];
            $password=$arr[1];
            $hash=hash("sha1",$password);
            $sql="SELECT * from `user` where email= '{$email}';";
            $result = mysqli_query($conn,$sql);

            if(!$result)
            {
                echo "login_error\n";
                echo mysqli_error($conn);
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
                else 
                {
                    if(empty($row['username'])) echo "no email";
                    else echo "password is wrong";    
                }
            }

            