<?php
    header('Content-Type: application/json; charset=utf8');
    $conn = mysqli_connect('localhost','root','skyjPstagram','pstagram');
    if(!empty($_GET['user_id']))
    {
        //입력 존재 => 특정 사람의 feed
        $user_id=$_GET['user_id'];
        $item=$_GET['item'];
        $page=$_GET['page'];
        $sql="SELECT * from `review` where user_id= '{$user_id}';";
        $result = mysqli_query($conn,$sql);
        $cnt=0;
        $array_total=array();

        while ($row = mysqli_fetch_array($result))
        {
            if($item * ($page -1) -1< $cnt && $cnt < $item * ($page))
            {
                $sql2="SELECT * from `user` where user_id= '{$user_id}';";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_array($result2);

                $array_unit=array(
                    'username' => $row2['username'],
                    'user_id' => $row['user_id'],
                    'content' => $row['content'],
                    'created_at' => $row['created_at'],
                    'profile_url' => $row2['profile_url'],
                    'photo_url' => $row['photo_url'],
                    'review_id' => $row['review_id']
                );
                array_push($array_total, $array_unit);
            }
            $cnt = $cnt +1;
        }
        echo str_replace('\\/', '/',json_encode($array_total,JSON_UNESCAPED_UNICODE));
    }
    else 
    {
        //입력 없음 => 전체 feed
        $item=$_GET['item'];
        $page=$_GET['page'];
        $sql="SELECT * from `review`;";
        $result = mysqli_query($conn,$sql);
        $cnt=0;
        $array_total=array();

        while ($row = mysqli_fetch_array($result))
        {
            if($item * ($page -1) -1< $cnt && $cnt < $item * ($page))
            {
                $sql2="SELECT * from `user` where user_id= '{$row['user_id']}';";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_array($result2);

                $array_unit=array(
                    'username' => $row2['username'],
                    'user_id' => $row['user_id'],
                    'content' => $row['content'],
                    'current_page' => $page,
                    'created_at' => $row['created_at'],
                    'profile_url' => $row2['profile_url'],
                    'photo_url' => $row['photo_url'],
                    'review_id' => $row['review_id']
                );
                array_push($array_total, $array_unit);
            }
            $cnt = $cnt +1;
        }
        echo str_replace('\\/', '/',json_encode($array_total,JSON_UNESCAPED_UNICODE));
    }
    mysqli_close($conn);
?>