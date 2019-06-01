<?php
    header('Content-Type: application/json; charset=utf8');
    include '../server_init.php';

    $flag = 1;
    $error_number=-1;
    $msg="";


    $data = file_get_contents('php://input');
    $arr = json_decode($data,true);
    $user_id = $arr['user_id'];
    $content = $arr['content'];
    $rate = $arr['rate'];
    
    /*
    $user_id = $_POST['user_id'];
    $content = $_POST['content'];
    $rate = $_POST['rate'];
    */

    $created_at = date("Y-m-d H:i:s");


    $target_dir = "C:/Bitnami/wampstack-7.1.29-0/apache2/htdocs/pstagram/uploads/"; //설정 중요
    $target_file = $target_dir . basename($_FILES["image_upload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $photo_url = $target_dir.hash("sha1",$created_at.$user_id).".".$imageFileType;
    
    $target_dir2 = "uploads/";
    $img_url= $target_dir2 . hash("sha1",$created_at.$user_id).".".$imageFileType;
    
    // 실제 이미지인지 페이크 이미지인지 확인
    /*if(isset($_POST["submit"])) 
    {
        $check = getimagesize($_FILES["image_upload"]["tmp_name"]);
        if($check !== false) 
        {
            $flag = 1;
        } 
        else 
        {
            $error_number = 1; // 이미지가 fake 이미지입니다.
            $flag = 0;
        }
    }
    */
    /* 파일이 이미 존재하는가?
    if (file_exists($target_file)) 
    {
        echo "Sorry, file already exists.";
        $flag = 0;
    }*/

    // 파일사이즈 체크
    if ($_FILES["image_upload"]["size"] > 500000) 
    {
        $error_number = 2; //파일의 사이즈가 너무 큽니다.
        $flag = 0;
    }
    // 파일 형식 허용
    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "GIF" && $imageFileType != "PNG" && $imageFileType != "JPEG") 
    {
        $error_number = 3; // 파일의 형식이 잘못되었습니다.
        $flag = 0;
    }


    // flag가 0일때(업로그가 실패한 경우)
    if ($flag == 0) 
    { 
        $code = "error";
        $error_msg = "error";
        if($error_number == 1)
        {
            $error_msg="이미지가 아닙니다.";
        }
        else if($error_number == 2)
        {
            $error_msg="이미지의 용량이 너무 큽니다.";
        }
        else if($error_number == 1)
        {
            $error_msg="파일의 형식이 잘못되었습니다";
        }
        $data = array(
            'code' => $code,
            'msg' => $error_msg
        );
        echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));    
    } 
    else //업로드가 완료된 경우 
    {
        if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $photo_url)) 
        {
            $sql = "INSERT INTO `review` (`user_id`, `content`,`photo_url`,`rate`,`created_at`) VALUES ('$user_id' , '$content','$img_url','$rate','$created_at')";
            $result = mysqli_query($conn,$sql);
            
            if(!$result)
            {
                $data = array(
                    'code' => "error",
                    'msg' => "업로드 과정 중, 에러가 발생하였습니다."
                );
                echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));    
            }
            else 
            {
                $data = array(
                    'code' => "success",
                    'msg' => "업로드를 성공하였습니다."
                );
                echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));
            }
        } 
        else 
        {
            $data = array(
                'code' => "error",
                'msg' => "업로드 과정 중, 에러가 발생하였습니다."
            );
            echo str_replace('\\/', '/',json_encode($data,JSON_UNESCAPED_UNICODE));
        }
    }
    mysqli_close($conn);
?>