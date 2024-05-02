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
 

// Function to toggle foreign key checks
function toggleForeignKeyChecks($obj, $enable) {
    $status = $enable ? 1 : 0;
    $query = "SET FOREIGN_KEY_CHECKS = $status";
    $obj->dbConn()->query($query);
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Disable foreign key checks
    toggleForeignKeyChecks($obj, false);

    // Delete related reservations first
    $sql_delete_reservations = "DELETE FROM reservation WHERE guest = $delete_id";
    mysqli_query($obj->dbConn(), $sql_delete_reservations);

    // Now delete the guest record
    $sql_delete_guest = "DELETE FROM guest WHERE id = $delete_id";
    $result_delete_guest = mysqli_query($obj->dbConn(), $sql_delete_guest);

    // Enable foreign key checks
    toggleForeignKeyChecks($obj, true);
    
    if ($result_delete_guest) {
        // Display success message
        $error[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Guest successfully Deleted.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    } else {
        // Display error message
        $error[] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error</strong> 
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
    <title>Guest</title>
    <style>
        .table thead th {
            text-align: center;
            background-color: #212529;
            color: #fff;
            border-color: #32383e;
        }
        td{
            text-align: center;
        }
        .pagination-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
            margin-left: 20px;
        }
    #btn1{
       padding-left: 18px;
       padding-right: 18px;
       margin: 5px;
    }

   #btn2{
    margin: 5px;
   }
    </style>
</head>
<body>
    <?php
    
    // Pagination variables
    $limit = 10; // Number of records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    // Fetch guests for the current page
    $sql = "SELECT * FROM guest WHERE id > 1 LIMIT $start, $limit";
    $result = mysqli_query($obj->dbConn(), $sql);
     

    // Total number of records
    $total_records = mysqli_num_rows(mysqli_query($obj->dbConn(), "SELECT * FROM guest WHERE id > 1"));
    // Total number of pages
    $total_pages = ceil($total_records / $limit);
    $count = 1; 

    
    ?>
     

    <?php require_once("navbar.php"); ?>

    <div class="container Body-1">
        
        <h2 class="p-3">Guest List</h2>
        <?php
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Address</th>
                    <th  >Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <?php  echo "<td> <strong>".$count++."</strong></td>";?>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row["phone_no"]; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td  >
    <button id="btn2" class="btn btn-primary" onclick="location.href='confirmRequest.php?requestID=<?php echo $row['id']; ?>';">Confirm</button>
    <form method='post' onsubmit="return confirm('Are you sure you want to delete this record?')">
        <button type='submit' id="btn1"class='btn btn-danger' name='delete_id' value='<?php echo $row['id']; ?>'> Delete </button>
    </form>
</td>

                <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No data found</td></tr>";
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
