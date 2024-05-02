<?php 
session_start();
include_once("classes/config.php");

$obj = new dbCon;
$conn = $obj->dbConn();
$guestID = $_SESSION['guestID'] ?? null;

if (!$guestID) {
    header("Location: login.php");
    exit();
}
extract($_POST);

if(isset($submit)){
  $fname = $firstname;
  $lname = $lastname;
  $ages = $age;
  $emails = $email;
  $phoneNo = $phone_no;
  $location = $address;

  $checkIn = $checkinDate;
  $checkOut = $checkoutDate;
  $reservationDate =date('Y-m-d H:i:s');
  
  if(!is_numeric($ages)) {
   
    $error[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Age must be A number</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
} else {
    $error[] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>You Reserved a Room</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
    $obj->addData($firstname, $lastname, $age, $email, $phone_no, $address, $checkIn, $checkOut, $reservationDate, $_GET['room_id']);
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       .form-box {
    max-width: 1000px; /* Change this value to adjust the width */
    margin: 3rem auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


        .decp {
            height: 40vh;
            padding: 2rem 7%;
        }

        .decp h1 {
            text-align: center;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 20px;
        }

        input[type="submit"] {
            border-radius: 20px;
            padding: 10px 30px;
        }

        input[type="submit"]:hover {
            background-color: #0069d9;
         
}
        /* Increase font size for labels and inputs */
.form-group label,
.form-control {
    font-size: 14px;
    padding: 5px;
}

p{
    font-size: 14px;
}
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="container ">
        
        <div class="form-box">
        <?php
        // Display error messages
        if(isset($error)){
            foreach($error as $msg){
                echo '<span>'.$msg.'</span>';
            }
        }
        ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?room_id=<?php echo $_GET['room_id']; ?>" method="POST" class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" required autocomplete="off">
                    </div>
                    <div class="form-group">
    <label>Age</label>
    <input type="text" name="age" class="form-control" required min="1" max="150">
</div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required autocomplete="off" placeholder="example@gmail.com">
                    </div>

                    <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone_no" class="form-control" placeholder="Enter Phone Number" required autocomplete="off">
                </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" required autocomplete="off">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Check in</label>
                        <input type="datetime-local" name="checkinDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Check out</label>
                        <input type="datetime-local" name="checkoutDate" class="form-control">
                    </div>

                    <div class="form-group">
                        <p>Room No: <?php echo $_GET['room_id']; ?></p>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" value="Book" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include_once("components/footer.php"); ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>

