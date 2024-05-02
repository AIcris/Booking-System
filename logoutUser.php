<?php
session_start();
if(isset($_SESSION['guestID'])){
    unset($_SESSION['guestID']); // unset the session variable 'guestID'
    
}

header('Location: login.php');
exit;
?>