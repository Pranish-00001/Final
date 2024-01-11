<html>
<link rel="stylesheet" type="text/css" href="register_edit.css">
<title>Register</title>
<head>

</head>
<body>
<div class="container">
<form method="post" action="insert_user.php">
    <label for="shop-name">Shop Name:</label>
    <input type = "text" name="name" id="shop-name" required><br>
    <label>Email:</label>
    <input type = "email" name="email" required><br>
    <label>Password:</label>
    <input type ="password" name="password" required><br>
    <input type="submit">
</form>
</div>
<p align = "center"><a href="Home_page.html" class="my-button">Back</a></p>
<p align = "center"><a href="Login.php">Already have an account?</a></p>
</body>
</html>
