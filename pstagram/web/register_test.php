<!DOCTYPE html>
<html>
    <head>
    </head>


    <body>
        <h2> 사용자 등록 기능 </h2>
        <form action=../api/profile/register.php method="POST">
        username <input type = "text" name="register[]">
        email <input type = "text" name="register[]">
        password <input type = "password" name="register[]">
        <button type="submit">제출</button>
    </body>
</html>