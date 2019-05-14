<!DOCTYPE html>
<html>
    <head> </head>

    <body> 
        <?php
            $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
            $arr=$_POST['register'];
            $username = $arr[0];
            $id = $arr[1];

            $sql = "INSERT INTO `users` (`id`, `username`) VALUES ('$id' , '$username')";
            $result = mysqli_query($conn,$sql);
            if(!$result)
            {
                echo "error, can't insert data";
                echo mysqli_error($conn);
            }
            else 
            {
                echo "success";
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
