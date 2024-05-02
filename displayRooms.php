<?php
session_start();
include_once "classes/config.php";

$db = new dbCon();
$db->dbConn();
$guestID = $_SESSION['guestID'] ?? null;

if (!$guestID) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM room WHERE id > 1";
$result = mysqli_query($db->dbConn(), $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            font-family: Arial, sans-serif;
        }
        
        .room-box {
            width: 100%;
            border-radius: 10px;
            margin: 20px 0;
            overflow: hidden;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }

        .room-box:hover {
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.2);
        }

        .room-box .room-image {
            position: relative;
            width: 100%;
            height: 190px;
            overflow: hidden;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .room-box .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .room-box:hover .room-image img {
            transform: scale(1.1);
        }

        .room-box .room-details {
            padding: 20px;
            background: #f8f9fa;
            text-align: left;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .room-box .room-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        .room-box .room-details p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .room-box .room-details .btn {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
            color: #fff;
            transition: background-color 0.3s ease-in-out;
        }

        .room-box .room-details .btn:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include_once("./components/user_header.php"); ?>
    <div class="container">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-4">
                <div class="room-box">
                    <div class="room-image">
                        <img src="img/<?php echo htmlspecialchars($row['image']); ?>" width="600" height="400" title="/<?php echo htmlspecialchars($row['image']); ?>" alt="Room Image">
                    </div>
                    <div class="room-details">
                        <h4>Category: <?php echo htmlspecialchars($row['category']); ?></h4>
                        <p>Per Night: $<?php echo htmlspecialchars($row['price']); ?></p>
                        <p>Person Capacity: <?php echo htmlspecialchars($row['personNo']); ?></p>
                        <p>Room No: <?php echo htmlspecialchars($row['id']); ?></p>
                        <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                        <p>Perks: <?php echo htmlspecialchars($row['perks']); ?></p>
                        <a id="book" href="Book.php?room_id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-info">Book Now</a>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="room-box">
                    <h2>No room found</h2>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php include_once("./components/footer.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>