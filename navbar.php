<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("classes/config.php");
$obj = new dbCon;
$obj->dbConn();
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Redirect if user is not logged in
if(!isset($id)){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <title>Responsive Navbar</title>
  <style>
    /* Custom styles */
    body {
      padding-top: 70px;     
    }
    .navbar {
      background-color: #212529; /* dark navbar */
    }
    .navbar-brand {
      font-size: 24px;
    }
    .nav-link {
      font-size: 18px;
      margin-right: 20px;
      color: #ffff; /* changed color */
    }
    .btn-logout {
      font-size: 18px;
      padding: 8px 20px;
    }
    .btn-logout:hover {
      color: #fff;
    }
    .nav-item.active .nav-link {
      color: #ffc107 !important;
    }
    .nav-link:hover {
      color: #ffc107 !important;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
  <h1><a class="navbar-brand" href="#">Welcome Admin</a></h1>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'adminPanel.php') echo 'active'; ?>">
        <a class="nav-link" href="adminPanel.php"><i class="fas fa-chart-bar"></i> Dashboard</a>
      </li>
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'combined.php') echo 'active'; ?>">
        <a class="nav-link" href="combined.php"><i class="fas fa-bed"></i> Rooms</a>
      </li>
      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'checkin.php') echo 'active'; ?>">
        <a class="nav-link" href="checkin.php"><i class="fas fa-user-check"></i> Check In</a>
      </li>

      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'guest.php') echo 'active'; ?>">
        <a class="nav-link" href="guest.php"><i class="fas fa-users"></i> Guest </a>
      </li>

      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'account.php') echo 'active'; ?>">
        <a class="nav-link" href="account.php"><i class="fas fa-user"></i> Users </a>
      </li>

      <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'concern.php') echo 'active'; ?>">
        <a class="nav-link" href="concern.php"><i class="fas fa-envelope"></i> Messages </a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="btn btn-danger btn-logout" href="logoutAdmin.php" onclick="return confirmLogout();"><i class="fas fa-sign-out-alt"></i> Logout</a>

      </li>
    </ul>
  </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>

</html>