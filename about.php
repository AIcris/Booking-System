<?php
session_start();
include_once("classes/config.php");

$db = new dbCon();
$db->dbConn();
$guestID = $_SESSION['guestID'] ?? null;

if (!$guestID) {
    header("Location: login.php");
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
    <body>
    <?php include 'components/user_header.php'; ?>
    
<section class="about" id="about">

   <div class="row">
      <div class="image">
         <img src="images/about-img-1.jpg" alt="">
      </div>
      <div class="content">
         <h3>Best Staffs</h3>
         <p>Welcome to our hotel, where exceptional service is our promise and our staff is our pride. From the moment you arrive, our team is dedicated to making your stay unforgettable.
            Our front desk team greets you with a smile and ensures a smooth check-in process. Need local recommendations or special arrangements? Our concierge team is here to assist, crafting personalized experiences just for you.
            Behind he scenes, our reservation specialists work diligently to handle every detail of your booking, while our housekeeping team ensures your room is a haven of cleanliness and comfort.
            At our hotel, hospitality isn't just a job – it's our passion. Our staff is more than ready to make your stay memorable. Welcome to a world of exceptional service. Welcome to our hotel.</p>
      </div>
   </div>

   <div class="row revers">
      <div class="image">
         <img src="images/about-img-2.jpg" alt="">
      </div>
      <div class="content">
         <h3>Best Rooms</h3>
         <p>At our hotel, where comfort meets style in every room category. Whether you're traveling with family, friends, or solo, we have the perfect accommodation to suit your needs.
<br>
Family Rooms: Spacious comfort for the whole family.
<br>
Twin Bedrooms: Ideal for friends or colleagues traveling together.
<br>
Single Rooms: Perfect for solo travelers seeking comfort and convenience.
<br>
No matter which room category you choose, you can rest assured that comfort and convenience are our top priorities. Welcome to a world of exceptional accommodations. Welcome to our hotel.</p>
      </div>
   </div>

   <div class="row">
      <div class="image">
         <img src="images/about-img-3.jpg" alt="">
      </div>
      <div class="content">
         <h3>Best Views</h3>
         <p>Experience unparalleled natural beauty at our hotel, where every window offers breathtaking beachfront panoramas and stunning nature vistas.

Wake up to the soothing sound of waves and watch the sunrise over the horizon from your beachfront room. Spend your days lounging on the soft sand or exploring nearby forests with winding trails leading to hidden waterfalls and scenic overlooks.

In the evening, gather around a beach bonfire under the stars, creating memories that last a lifetime.

Welcome to a world of unforgettable views. Welcome to our hotel.</p>
      </div>
   </div>

</section>

<?php include 'components/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script src="js/script.js"></script>
    </body>

<html>