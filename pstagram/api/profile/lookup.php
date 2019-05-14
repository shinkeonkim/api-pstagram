<!DOCTYPE html>
<html>
    <head> </head>

    <body>
        <?php
            if(isset($_GET['userId']))
            {
                $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
                $userId=$_GET['userId'];
                $sql ="SELECT * FROM `users` WHERE userId= {$_GET['userId']};";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                mysqli_close($conn);
                
                $username=$row['username'];
                $id=$row['id'];
                
                $data = array(
                    'userId' => $userId,
                    'id' => $id,
                    'name' => $username
                );
                
                echo json_encode($data);

            }
        ?> 
    </body>

</html>