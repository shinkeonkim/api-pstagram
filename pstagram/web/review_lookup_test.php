<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <h2> 리뷰 조회 기능 </h2>
        <form action=../api/review/review_lookup.php method="GET">
            user_id <input type = "text" name="user_id">
            page <input type = "text" name = "page">
            item <input type = "text" name ="item">
        <button type="submit">제출</button>
    </body>
</html>