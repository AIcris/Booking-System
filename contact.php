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


    

   if(isset($_POST["send"])){
      $name = $_POST['username'] ?? '';
      $mail = $_POST['email'] ?? '';
      $phoneNo = $_POST['phone_no'] ?? '';
      $msg = $_POST['message'] ?? '';

      $db->concern( $name, $mail, $phoneNo, $msg);


   }

?>




<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php include 'components/user_header.php'; ?>
<section class="contact" id="contact">

   <div class="row">

      <form   method="post">
         <h3>send us message</h3>
         <input type="text" name="username"  placeholder="enter your name" class="box">
         <input type="email" name="email" placeholder="enter your email" class="box">
         <input type="number" name="phone_no"   min="0" max="9999999999" placeholder="enter your number" class="box">
         <textarea name="message" class="box"   placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>

      <div class="faq">
    <h3 class="title">Frequently Asked Questions</h3>
    <div class="box active">
        <h3>How can I cancel my subscription?</h3>
        <p>To cancel your subscription, please log in to your account and navigate to the settings page. From there, you'll find an option to cancel your subscription. Follow the instructions provided to complete the cancellation process.</p>
    </div>
    <div class="box">
        <h3>Are there any vacancies available?</h3>
        <p>We're always on the lookout for talented individuals to join our team! Please visit our careers page to view any current job openings and to submit your application.</p>
    </div>
    <div class="box">
        <h3>What payment methods do you accept?</h3>
        <p>We accept a variety of payment methods to make your shopping experience convenient. These include credit/debit cards, PayPal, and bank transfers. If you have any specific payment-related queries, feel free to reach out to our support team.</p>
    </div>
    <div class="box">
        <h3>How do I claim coupon codes?</h3>
        <p>To claim coupon codes, simply add your desired items to your shopping cart and proceed to checkout. During the checkout process, you'll find a field where you can enter your coupon code. Enter the code and click 'Apply' to redeem the discount.</p>
    </div>
    <div class="box">
        <h3>What are the age requirements for using your service?</h3>
        <p>Our service is intended for individuals who are 18 years of age or older. If you are under the age of 18, please seek parental consent before using our service.</p>
    </div>
</div>


</section>
 

   <?php include 'components/footer.php'; ?>
   <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script src="js/script.js"></script>

    
</body>
</html>