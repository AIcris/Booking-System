<?php

 include_once("classes/config.php");
 $obj = new dbCon;
 $obj->dbconn();
 if(isset($_GET['id'])) {
    $deleteID = $_GET['id'];
     
   if( $obj->delete($deleteID)){

    echo '<script>alert("Data deleted successfully"); window.location.href = "combined.php";</script>';
    exit();
   }else{
    echo '<script>alert("Failed to delete data")</script>';
   }
}  

?>
