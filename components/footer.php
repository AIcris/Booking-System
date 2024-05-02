 


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<style>
   
</style>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home Page</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
 
   
   <style>
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
         margin-right: 20px;
      }

      .social-links li i {
         font-size: 24px;  
      }

      .footer-column .contact-us-icons i {
         font-size: 32px; 
      }

      .footer-column a {
         color: #ccc;  
         text-decoration: none;
         transition: color 0.3s ease;
      }

      .footer-column a:hover {
         color: #fff;   
         text-decoration: underline;  
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

      .footer-column a.logout-link {
      color: #2B1103;
      background-color:#DCC69C; /* Red color for emphasis */
      padding: 10px 20px; /* Adjust padding for better appearance */
      border-radius: 5px; /* Rounded corners for a button-like appearance */
      display: inline-block; /* Ensure block display for padding to work correctly */
      transition: background-color 0.3s ease;
   }

   /* Hover effect for the logout link */
   .footer-column a.logout-link:hover {
     
      text-decoration: none; /* Remove underline on hover */
   }
   </style>

</head>
<body>

 

<footer class="footer">
   <div class="footer-container">
      <div class="footer-column">
         <h3>Contact Us</h3>
         <ul>
            <li><i class="fas fa-map-marker-alt"></i>CLSU - Munoz, 3120</li>
            <li><i class="fas fa-phone-alt"></i> 0987-654-3211</li>
            <li><i class="fas fa-envelope"></i> wonderluxehotelg@gmail.com</li>
         </ul>
      </div>
      <div class="footer-column">
         <h3>Quick Links</h3>
         <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#gallery">Gallery</a></li>
         </ul>
      </div>
      <div class="footer-column">
         <h3>Follow Us</h3>
         <ul class="social-links">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
         </ul>
      </div>

      <div class="footer-column">
      <a class=" logout-link" href="logoutUser.php" onclick="return confirmLogout();"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

   </div>
   <div class="footer-bottom">
      <p>&copy; 2024 Wonder Luxe Hotel. All rights reserved.</p>
   </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>

</body>
<script>
    function confirmLogout() {
        return confirm("Are you sure you want to logout?");
    }
</script>
</html>