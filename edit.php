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

$updateID = isset($_GET['updateID']) ? $_GET['updateID'] : '';
$category = '';
$status = '';
$perks = '';
$error = [];

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];
    $personNo = $_POST['personNo'];
    $status = $_POST['status'];
    $perks = $_POST['perks'];

    // Check if a file was uploaded
    if(isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['uploadfile']['name'];
        $filetmpname = $_FILES['uploadfile']['tmp_name'];
        $folder = 'img/';
        move_uploaded_file($filetmpname, $folder.$filename);
    } else {
        $filename = null; // Set filename to null if no file is uploaded
    }

    // Check if all fields are filled
    if ($category && $price && $personNo && $status && $perks !== '') {
        if (!is_numeric($updateID) || $updateID <= 0) {
            // Handle the error, e.g. by displaying an error message or redirecting to an error page
            exit();
        }

        $error[] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Updated successfully!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        $obj->updateRoom($category, $price, $personNo, $filename, $status,$perks, $updateID);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-box {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-top: 50px;
        }

        .decp{
            height: 40vh;
            padding: 2rem 7%;
        }

        .decp h1{
            text-align: center;
        }

        /* Add some styling to the dropdown menu */
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
background-size: 18px 18px;
            padding-right: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            height: 44px;
            padding: 0 10px;
            font-size: 16px;
            line-height: 44px;
            width: 100%;
        }

        select:focus {
            outline: none;
            box-shadow: 0 0 2px 1px rgba(0, 122, 255, 0.5);
        }
    </style>
</head>
<body>
    <?php require_once('navbar.php'); ?>

    <div class="container">
        <div class="form-box">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?updateID=' . $updateID; ?>" method="POST" class="row" enctype="multipart/form-data">
                <div class="col-md-12">

                    <?php foreach($error as $msg): ?>
                        <?php echo $msg; ?>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="Single Bed" <?php echo ($category == 'SingleBed') ? 'selected' : ''; ?>>Single Bed</option>
                            <option value="Double Bed" <?php echo ($category == 'DoubleBed') ? 'selected' : ''; ?>>Double Bed</option>
                            <option value="Kingsize Bed" <?php echo ($category == 'KingsizeBed') ? 'selected' : ''; ?>>Kingsize Bed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" required value="<?php echo $price; ?>">
                    </div>

                    <div class="form-group">
                        <label>Number of Person</label>
                        <input type="number" name="personNo" class="form-control" required value="<?php echo $personNo; ?>">
                    </div>

                    <div class="form-group">
                        <label for="category">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Available" <?php echo ($status == 'Available') ? 'selected' : ''; ?>>Available</option>
                            <option value="Not_Available" <?php echo ($status == 'Not_Available') ? 'selected' : ''; ?>>Not Available</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Perks:</label>
                        <select class="form-control" id="perks" name="perks">
                            <option value="With WiFi & Aircon" <?php echo ($perks == 'With WiFi & Aircon') ? 'selected' : ''; ?>>With WiFi & Airconditioner</option>
                            <option value="With WiFi"  <?php echo ($perks == 'With WiFi') ? 'selected' : ''; ?>> with WiFi</option>
                            <option value="With WiFi & Electric Fan"  <?php echo ($perks == 'With WiFi & Electric Fan') ? 'selected' : ''; ?>>With and Electric Fan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="images">Images:</label>
                        <input type="file" class="form-control-file" name="uploadfile" value="<?php echo $image; ?>">
                    </div>

                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>