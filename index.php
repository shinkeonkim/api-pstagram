<html>
  <body>
    <div id="feed">
      <h3> 피드 관련 </h3>

    </div>

    <div id="user">
    <h3> 사용자 관련 </h3>
    프로필 조회 기능
    <form action="pstagram/api/profile/lookup.php" method="GET">
      userId 조회<input type = "text" name = "userId">
      <button type="submit">제출</button>
    </form>

    사용자 등록 기능
    <form action=pstagram/api/profile/register.php method="POST">
      이름 <input type = "text" name="register[]">
      아이디 <input type = "text" name="register[]">
      <button type="submit">제출</button>
    </div>


    
    <div id="category">
    <h3> 카테고리 관련</h3>
    </div>
</html>

