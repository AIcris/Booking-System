<?php
session_start(); 

// check if the user is logged in
if(isset($_SESSION['id'])){
    unset($_SESSION['id']); // unset the session variable 'id'
     
}

header('Location: login.php');
exit;

?>