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

 


// Pagination variables
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM reservation WHERE id > 1 LIMIT $start, $limit";
$result = mysqli_query($obj->dbConn(), $sql);

$total_records = mysqli_num_rows(mysqli_query($obj->dbConn(), "SELECT * FROM reservation WHERE id > 1"));
$total_pages = ceil($total_records / $limit);
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check In</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
          .Body-1 {
            height: 100vh;
        }
        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            text-align: center;
            background-color: #212529;
            color: #fff;
            border-color: #32383e;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0,0,0,.125);
        }
        .table-striped tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        td {
            text-align: center;
        }
        .pagination-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <?php require_once("navbar.php"); ?>
    <div class="container Body-1">
        <h2 class="p-3">Check Ins</h2>
        <?php
        // Display error messages
        if(isset($error)){
            foreach($error as $msg){
                echo '<span>'.$msg.'</span>';
            }
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>              
                    <th>No.</th>  
                    <th>Check In Date</th>
                    <th>Check Out Date</th>
                    <th>Reservation Date</th>
                    <th>Guest ID</th>
                    <th>Room ID</th>
                     
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><strong><?php echo $count++; ?></strong></td>
                    <td><?php echo $row['checkinDate']; ?></td>
                    <td><?php echo $row['checkoutDate']; ?></td>
                    <td><?php echo $row['reservationDate']; ?></td>
                    <td><?php echo $row['guest']; ?></td>
                    <td><?php echo $row['room']; ?></td>
                    
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</body>
 
</html>
