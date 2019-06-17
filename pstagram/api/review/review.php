<?php
    header('Content-Type: application/json; charset=utf8');
    include '../server_init.php';
    
    if(!empty($_GET['user_id']))
    {
        //입력 존재 => 특정 사람의 feed
        $user_id=$_GET['user_id'];
        $item=$_GET['item'];
        $page=$_GET['page'];

        $start= $item * ($page -1);
        
        $sql="SELECT count(*) from `review`";
        $cnt = mysqli_query($conn,$sql);
        $sql="SELECT * from `review` where user_id= '{$user_id}' order by `created_at` desc limit $item OFFSET $start;";
        $result = mysqli_query($conn,$sql);
        $array_total=array();
        $array_arr=array();

        while ($row = mysqli_fetch_array($result))
        {
            $sql2="SELECT * from `user` where user_id= '{$user_id}';";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_array($result2);

            $array_unit=array(
                'username' => $row2['username'],
                'user_id' => $row['user_id'],
                'content' => $row['content'],
                'rate' => $row['rate'],
                'created_at' => $row['created_at'],
                'profile_url' => $server_url.$row2['profile_url'],
                'photo_url' => $server_url.$row['photo_url'],
                'review_id' => $row['review_id']
            );
            array_push($array_arr, $array_unit);
        }

        if($cnt % $item == 0 && $cnt ==0)
        {
            $array_total['max_page']=(int)($cnt/$item);
        }
        else 
        {
            $array_total['max_page']=(int)($cnt/$item)+1;
        }
        $array_total['current_page']=$page;
        $array_total['data']=$array_arr;


        echo str_replace('\\/', '/',json_encode($array_total,JSON_UNESCAPED_UNICODE));
    }
    else 
    {
        //입력 없음 => 전체 feed
        $item=$_GET['item'];
        $page=$_GET['page'];
        $start= $item * ($page -1);

        $sql="SELECT count(*) from `review`";
        $cnt = (int)mysqli_query($conn,$sql);
        $sql="SELECT * from `review` order by `created_at` desc limit $item OFFSET $start;";
        $result = mysqli_query($conn,$sql);
        $array_total=array();
        $array_arr=array();
        while ($row = mysqli_fetch_array($result))
        {
            $sql2="SELECT * from `user` where user_id= '{$row['user_id']}';";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_array($result2);

            $array_unit=array(
                'username' => $row2['username'],
                'user_id' => $row['user_id'],
                'content' => $row['content'],
                'rate' => $row['rate'],
                'created_at' => $row['created_at'],
                'profile_url' => $server_url.$row2['profile_url'],
                'photo_url' => $server_url.$row['photo_url'],
                'review_id' => $row['review_id']
            );
            array_push($array_arr,$array_unit);
        }
        if($cnt % $item == 0 && $cnt ==0)
        {
            $array_total['max_page']=(int)($cnt/$item);
        }
        else 
        {
            $array_total['max_page']=(int)($cnt/$item)+1;
        }
        $array_total['current_page']=$page;
        $array_total['data']=$array_arr;
        echo str_replace('\\/', '/',json_encode($array_total,JSON_UNESCAPED_UNICODE));
    }
    mysqli_close($conn);
?>