<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .Cons {
      height: 90vh;
      padding: 13px;
    }
    .stats-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    .stats-card:hover {
      transform: translateY(-5px);
    }
    .stats-icon {
      font-size: 3em;
      color: #6c757d;
    }
    .stats-number {
      font-size: 2em;
      font-weight: bold;
    }
    .stats-label {
      font-size: 1.2em;
      color: #6c757d;
    }
  </style>
</head>
<body>
  <?php require_once("navbar.php"); ?>

  <?php
    $sql = "SELECT COUNT(*) as total_reservations FROM reservation WHERE id > 1"; // Counting total reservations
    $result = mysqli_query($obj->dbConn(), $sql);
    $data = mysqli_fetch_assoc($result);
    $total_reservations = $data['total_reservations'];

    $sql = "SELECT COUNT(*) as total_rooms FROM room WHERE id > 1"; // Counting total reservations
    $result = mysqli_query($obj->dbConn(), $sql);
    $data = mysqli_fetch_assoc($result);
    $total_rooms = $data['total_rooms'];

    $sql = "SELECT COUNT(*) as total_guest FROM guest WHERE id > 1"; // Counting total rooms
    $result = mysqli_query($obj->dbConn(), $sql);
    $data = mysqli_fetch_assoc($result);
    $total_guest = $data['total_guest'];

    $sql = "SELECT COUNT(*) as total_user FROM login WHERE id > 1"; // Counting total users
    $result = mysqli_query($obj->dbConn(), $sql);
    $data = mysqli_fetch_assoc($result);
    $total_user = $data['total_user'];

    $sql = "SELECT COUNT(*) as total_contact FROM contact WHERE id > 1"; // Counting total users
    $result = mysqli_query($obj->dbConn(), $sql);
    $data = mysqli_fetch_assoc($result);
    $total_contact = $data['total_contact'];
  ?>

  <div class="Cons">
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6">
          <div class="card stats-card">
            <div class="card-body text-center">
              <i class="fas fa-user-check stats-icon"></i>
              <h5 class="card-title mt-3">Check Ins</h5>
              <p class="card-text stats-number"><?php echo $total_reservations; ?></p> <!-- Display total reservations count -->
              <p class="card-text stats-label">Total</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card stats-card">
            <div class="card-body text-center">
              <i class="fas fa-bed stats-icon"></i>
              <h5 class="card-title mt-3">Number of Rooms</h5>
              <p class="card-text stats-number"><?php echo $total_rooms; ?></p>
              <p class="card-text stats-label">Total</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card stats-card">
            <div class="card-body text-center">
              <i class="fas fa-users stats-icon"></i>
              <h5 class="card-title mt-3">Number of Guests</h5>
              <p class="card-text stats-number"><?php echo $total_guest; ?></p>
              <p class="card-text stats-label">Total</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card stats-card">
            <div class="card-body text-center">
              <i class="fas fa-user-circle stats-icon"></i>
              <h5 class="card-title mt-3">Accounts</h5>
              <p class="card-text stats-number"><?php echo $total_user ?></p>
              <p class="card-text stats-label">Active</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card stats-card">
            <div class="card-body text-center">
              <i class="fas fa-envelope stats-icon"></i>
              <h5 class="card-title mt-3">Messages</h5>
              <p class="card-text stats-number"><?php echo $total_contact ?></p>
              <p class="card-text stats-label">Totals</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
