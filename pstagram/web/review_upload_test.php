<!DOCTYPE html>
<html>
<body>
 
<form action="../api/review/review_upload.php" method="post" enctype="multipart/form-data">
    user_id <input type="text" name ="user_id">
    content <input type="text" name="content">
    rate <input type="text" name="rate">
    product_name <input type="text" name="product_name">
    image_upload <input type="file" name="image_upload" id="image_upload">
    <input type="submit" value="Upload Image" name="submit">
</form>
 
</body>
</html>
