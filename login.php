<?php
    session_start();

    include_once("classes/config.php");

    $obj = new dbCon;
    $obj->dbConn();

    if(isset($_SESSION['id'])) {
      
        header("Location: adminPanel.php"); 
       
    }
    if(isset($_SESSION['guestID'])) {
        
        header("Location: index.php"); 
      
    }

    extract($_POST);
    if(isset($_POST['login'])){
        $mail = $email;
        $pass = $password;

        $obj->login($mail,$pass);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('./images/2690549.webp'); /* Replace 'hotel_view.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            width: 360px;
            padding: 30px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8); /* Added opacity to make it semi-transparent */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .login-form h2 {
            margin-bottom: 30px;
            
        }
        .login-form label {
            font-weight: bold;
        }
        .login-form input[type="email"], .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .login-form button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-form .create-account {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
        </form>
        <div class="create-account">
            <p>No Account yet? <a href="register.php">Create Account</a></p> 
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
