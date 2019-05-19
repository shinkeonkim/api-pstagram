<!DOCTYPE html>
<html>
    <head>
    </head>

    <body>
        <h2> 로그인 </h2>
        <form action=../api/profile/login.php method="POST">
            email <input type = "text" name = "login[]">
            password <input type = "password" name="login[]">
            <button type="submit">제출</button>
    </body>
</html>