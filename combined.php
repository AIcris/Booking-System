
<?php
session_start();

 include_once("classes/config.php");

 $obj = new dbCon;
 $obj->dbConn();
$id = $_SESSION['id'];  

if(!isset($id)){
    header("Location: login.php");
    exit();
}

 

 if (isset($_POST['add_room'])) {
     $category = $_POST['category'];
     $price = $_POST['price'];
     $personNo = $_POST['personNo'];
   
     $filename = $_FILES['uploadfile']['name'];
     $filetmpname = $_FILES['uploadfile']['tmp_name'];
     $folder = 'img/';
     move_uploaded_file($filetmpname, $folder.$filename);
     $status = $_POST['status'];
     $perks = $_POST['perks'];
     
     if($category && $price && $personNo && $status == TRUE) {

        $error[] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Room added successfully!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    $obj->addRoom($category,$price,$personNo,$filename,$status,$perks);
 }
 else{
    $error[] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> Check the data you inserted.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
 }
 }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            height: 200px;
            overflow: hidden;
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
            background: #fff;
            text-align: left;
        }

        .room-box .room-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .room-box .room-details p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .room-box .room-details .btn {
            margin-top: 15px;
        }

        .add-room-form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            transition: all 0.3s ease-in-out;
        }

        .add-room-form .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
        require_once("navbar.php");
    ?>
    <div class="container">
        <!-- Add Room Form -->
        <div class="add-room-form">
        <?php
        
        if(isset($error)){
            foreach($error as $msg){
                echo '<span>'.$msg.'</span>';
            }
        }
    
    ?>
            <h2 class="p-3">Add Room</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category">
                        <option value="Single bed">Single bed</option>
                        <option value="Double Bed">Double Bed</option>
                        <option value="Kingsize Bed">Kingsize Bed</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="images">Images:</label>

                <input type="file" class="form-control-file"   name="uploadfile" >
            </div>
                <div class="form-group">
                    <label for="price">Per Night:</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="personNo">Person Capacity:</label>
                    <input type="number" class="form-control" id="personNo" name="personNo" required>
                </div>
                <div class="form-group">
                    <label for="category">Status:</label>
                    <select class="form-control" id="status" name="status">
                        <option value="Available">Available</option>
                        <option value="Not_Available">Not Available</option>
                        
                    </select>

                    <div class="form-group">
                    <label for="category">Perks:</label>
                    <select class="form-control" id="perks" name="perks">
                        <option value="With WiFi & Aircon">With WiFi & Airconditioner</option>
                        <option value="With WiFi"> with WiFi</option>
                        <option value="With WiFi & Electric Fan">With Wifi and Electric Fan</option>
                       
                      
                    </select>
                    
                </div>
                <button type="submit" name="add_room" class="btn btn-primary">Add Room</button>
            </form>
        </div>

        <!-- Display Rooms -->
        <div class="row">
            <?php
               

                $sql = "SELECT * FROM room WHERE id > 1";
                $result = mysqli_query($obj->dbConn(), $sql);

                if  (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-4">
                <div class="room-box">
                    <div class="room-image">
                        <!-- Replace this image source with your actual room image -->
                        <img src="img/<?php echo $row['image']; ?>"width="600" height="400" title="/<?php echo $row['image']; ?>" alt="Room Image">
                    </div>
                    <div class="room-details">
                        <h2>Category: <?php echo $row['category']; ?></h2>
                        <p>Price: $<?php echo $row['price']; ?></p>
                        <p>Person Capacity: <?php echo $row['personNo']; ?></p>
                        <p>Room No: <?php  echo $row['id']; ?></p>
                        <p>Status: <?php echo $row['status']; ?> </p>
                        <p>Perks: <?php  echo $row['perks'];  ?></p>
                        <button class="btn btn-primary" onclick="location.href='edit.php?updateID=<?php echo $row['id']; ?>';">Edit</button>
                        <button class="btn btn-danger" onclick="deleteRoom(<?php echo $row['id']; ?>);">Delete</button>
                         
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
            ?>
            <div class="col-md-4">
                <div class="room-box">
                    <h2>No room found</h2>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    
    <script>
        function deleteRoom(id) {
            if (confirm("Are you sure you want to delete this room?")) {
                location.href='delete.php?id=' + id;
            }
        }
    </script>
</body>
</html>
