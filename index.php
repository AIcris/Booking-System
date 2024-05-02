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
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wonder Luxe</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
   <style>
      /* Footer Styles */
      .footer {
         background-color: #333;
         color: #fff;
         padding: 50px 0;
      }

      .footer-container {
         display: flex;
         justify-content: space-between;
         max-width: 1200px;
         margin: 0 auto;
         flex-wrap: wrap;
      }

      .footer-column {
         flex: 1 1 300px;
         padding: 0 20px;
         margin-bottom: 20px;
      }

      .footer-column h3 {
         margin-bottom: 20px;
      }

      .footer-column ul {
         list-style-type: none;
         padding: 0;
      }

      .footer-column ul li {
         margin-bottom: 10px;
      }

      .social-links {
         list-style-type: none;
         padding: 0;
         display: flex;
      }

      .social-links li {
         margin-right: 10px;
      }

      .footer-bottom {
         background-color: #222;
         padding: 10px 0;
         text-align: center;
      }

      .footer-bottom p {
         margin: 0;
      }

      /* Responsive Styling */
      @media screen and (max-width: 768px) {
         .footer-column {
            flex: 1 1 100%;
         }
      }

      /* Centering and Styling Book Now Button */
      .home button,
      .services button {
         display: block;
         margin: 0 auto;
         border:.1rem solid rgba(220, 198, 156, .3);
         background-color: transparent;
         color:  #DCC69C;
         padding: 1rem 3rem;
         font-size: 2rem;
         cursor: pointer;
         font-weight: 600;
         transition: background-color 0.3s ease;
         /* Set max-width to prevent the button from stretching too much on larger screens */
         max-width: 200px;
      }

      .home button:hover,
      .services button:hover {
         color: #2B1103;
         background-color:#DCC69C;;
      }

      /* Adjust button width for smaller screens */
      @media screen and (max-width: 768px) {
         .home button,
         .services button {
            /* Adjust width as per your design needs */
            max-width: none; /* Remove max-width for full-width button */
         }
      }

      .book {
         margin: 2rem;
      }
   </style>

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- home section starts  -->

<section class="home" id="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="box swiper-slide">
            <img src="uploads/Family-Bedroom-02.jpg" alt="">
            <div class="flex">
               <h3>Kingsize Bedrooms</h3>
            </div>
         </div>

         <div class="box swiper-slide">
            <img src="uploads/Twin-Bedroom-03.jpg" alt="">
            <div class="flex">
               <h3>Double Bedrooms</h3>
            </div>
         </div>

         <div class="box swiper-slide">
            <img src="uploads/Single-Bedroom-01.jpg" alt="">
            <div class="flex">
               <h3>Single Bedrooms</h3>
            </div>
         </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

   <div class="book">
     <a href="displayRooms.php"> <button>Book Now</button></a>
   </div>

</section>

<br><br><br><br><br>
<section class="services">
<h3><center>Services</center></h3><br><br><br>
   <div class="box-container">
      

      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>Food & Drinks</h3>
         <p>Quality and delicious foods and drinks</p>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>Outdoor Dining</h3>
         <p>Watch the beautiful view while eating</p>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>Beach view</h3>
         <p>Explore the beauty of the nature</p>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>Decorations</h3>
         <p>Aesthetic designs</p>
      </div>

      <div class="box">
         <img src="images/icon-5.png" alt="">
         <h3>Swimming pool</h3>
         <p>We also have a swimming pool</p>
      </div>

      <div class="box">
         <img src="images/icon-6.png" alt="">
         <h3>Beach</h3>
         <p>Enjoy the summer</p>
      </div>

   </div>

</section>

<section class="gallery" id="gallery">

   <div class="swiper gallery-slider">
      <div class="swiper-wrapper">
         <img src="images/gallery-img-1.jpg" class="swiper-slide" alt="">
         <img src="images/gallery-img-2.webp" class="swiper-slide" alt="">
         <img src="images/gallery-img-3.webp" class="swiper-slide" alt="">
         <img src="images/gallery-img-4.webp" class="swiper-slide" alt="">
         <img src="images/gallery-img-5.webp" class="swiper-slide" alt="">
         <img src="images/gallery-img-6.webp" class="swiper-slide" alt="">
      </div>
      <div class="swiper-pagination"></div>
   </div>

</section>

<?php include_once("components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/swiper
