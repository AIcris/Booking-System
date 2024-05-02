<?php 

session_start();
include_once("classes/config.php");
$obj = new dbCon;
$conon = $obj->dbConn();
$id = $_SESSION['id'];  

if(!isset($id)){
    header("Location: login.php");
    exit();
}

if(isset($_GET['delete_id'])) {
    // Handle the deletion process
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM contact WHERE id = $delete_id";
    if ($conon->query($sql_delete) === TRUE) {
        echo '<script>alert("Message Deleted Successfully"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
        exit();
    } else {
        echo '<script>alert("Error Deleting Message"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
    }
}

$sql = "SELECT * FROM contact WHERE id > 1";
$result = $conon->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once("navbar.php"); ?>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="container mt-4">
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Username: <?php echo $row['username'];  ?> </h5>
                <p class="card-text">Email: <?php echo $row['email'];  ?> </p>
                <p class="card-text">Phone Number: <?php echo $row['phone_no'];  ?> </p>
                <p class="card-text">Messages: <?php echo $row['message'];  ?> </p>
                <!-- Add delete button with alert confirmation -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo "<p>No Message</p>";
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
