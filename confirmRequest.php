<?php
session_start();
include_once("classes/config.php");
$obj = new dbCon;
$conn = $obj->dbConn();
$id = $_SESSION['id'];  

if(!isset($id)){
    header("Location: login.php");
    exit();
}

$id = isset($_GET['requestID']) ? $_GET['requestID'] : '';

// Initialize variables with session data or empty values
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$firstname = '';
$lastname = '';
$error = [];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['send'])){  
    // Store form data in session
    $_SESSION['email'] = $_POST['email'];

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'christianraguindin007@gmail.com';
    $mail->Password = 'rcnsbhwxgqbhkfhl';
    $mail->SMTPSecure = 'tls';  
    $mail->Port = 587; 

    $mail->setFrom('christianraguindin007@gmail.com');

    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    if($mail->send()){
        $error[] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Request Confirmed!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>';
    } else {
       $error[] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Error</strong> Check the data you inserted. 
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
   </div>';
    }
}
?>



<?php
 

 



if($id != ''){
    $sql = "SELECT * FROM `guest` WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $age = $row["age"];
        $email = $row["email"];
        $phone_no = $row["phone_no"];
        $address = $row["address"];

    }
}
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Request</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
            font-family: 'Open Sans', sans-serif;
        }
       .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 50px auto;
            max-width: 600px;
        }
       .form-label {
            font-weight: bold;
            color: #333;
        }
       .btn-send {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
       .btn-send:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
       .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }
       .form-group {
            margin-bottom: 20px;
        }
       .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include_once("navbar.php");?>
    <div class="container">
        <h3 class="text-center">Confirm Request</h3>
        
        <?php foreach($error as $msg):?>
                <div class="error"><?php echo $msg;?></div>
            <?php endforeach;?>
        <form action="<?php echo $_SERVER['PHP_SELF']. '?requestID='. $id;?>" method="POST" class="row" enctype="multipart/form-data">
        
            <div class="form-group col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
            </div>
            <div class="form-group col-md-6">
                <label class="form-label" for="subject">Subject</label>
                <select class="form-control" id="subject" name="subject">
                    <option value="Request Confirmed">Request Confirmed</option>
                    <option value="Request Denied">Request Denied</option>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label class="form-label">Message</label>
                <textarea class="form-control" name="message" rows="5" style="resize: none;">Hi <?php echo $firstname.' '.$lastname?> , your Room Request has been </textarea>

            </div>
            <div class="form-group col-md-12 text-center">
                <button class="btn btn-send" type="submit" name="send">Send</button>
            </div>
        </form>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</html>