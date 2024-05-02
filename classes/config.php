<?php 
 
class dbCon{
    public $db_host = "localhost";
    public $db_user ="root";
    public $db_pass ="";
    public $db_name ="newdbresort";

    public function dbConn(){
       

        $conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name);   
        if($conn->connect_error){
              echo 'Cannot connect to database'.$conn->connect_error;
          }else{
              return $conn;
          }
}


public function addData($firstname, $lastname, $age, $email, $phone_no, $address, $checkinDate, $checkoutDate, $reservationDate,$roomId){
    $conn = $this->dbConn();

    // Check if guest email already exists
    $sql = "SELECT id FROM guest WHERE email='$email'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        // Name or email already taken
        echo '<script>alert("Name or email already taken")</script>';
    } else {
        // Insert guest record
        $insert_guest = "INSERT INTO guest (firstname, lastname, age, email, phone_no, address) VALUES ('$firstname', '$lastname', '$age', '$email', '$phone_no', '$address')";
        
        if ($conn->query($insert_guest) === TRUE) {
            header("displayRooms.php");
            // Get the ID of the newly inserted guest
            $guest_id = $conn->insert_id;



            // Insert reservation record
            $reserve = "INSERT INTO reservation (checkinDate, checkoutDate, reservationDate, guest, room) VALUES ('$checkinDate', '$checkoutDate', '$reservationDate', '$guest_id', '$roomId')";

            if ($conn->query($reserve) === TRUE) {
                // Reservation successfully added
                
               
            } else {
                // Error inserting reservation record
                echo '<script>alert("Error inserting reservation record: ' . $conn->error . '")</script>';
                error_log("Error inserting reservation record: " . $conn->error);
            }
        } else {
            // Error inserting guest record
            echo '<script>alert("Error inserting guest record: ' . $conn->error . '")</script>';
            error_log("Error inserting guest record: " . $conn->error);
        }
    }
}




public function addRoom($category,$price,$personNo,$image,$status,$perks){

    $conn = $this->dbConn();
    $sql = "INSERT INTO room (category,price,personNo,image,status,perks) VALUES ('$category','$price','$personNo','$image','$status','$perks')";
    $conn->query($sql);

 
}

public function delete($id) {
    $conn = $this->dbConn();

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Disable foreign key checks
        $query = "SET FOREIGN_KEY_CHECKS = 0";
        $conn->query($query);

        // Delete the room record
        $sql = "DELETE FROM room WHERE id = $id";
        $stmt = $conn->prepare($sql);

        // Check for errors
        if ($stmt === false) {
            throw new \mysqli_sql_exception($conn->error);
        }

        // Execute the statement
        $result = $stmt->execute();

        // Check for errors
        if ($result === false) {
            throw new \mysqli_sql_exception($stmt->error);
        }

        // Enable foreign key checks
        $query = "SET FOREIGN_KEY_CHECKS = 1";
        $conn->query($query);

        // Commit transaction
        $conn->commit();

        // Close the statement
        $stmt->close();

        return true;
    } catch (\mysqli_sql_exception $e) {
        // Rollback transaction in case of an error
        $conn->rollback();

        // Rethrow the exception to be caught in the calling code
        throw $e;
    } finally {
        // Close the connection
        $conn->close();
    }
}
 
public function updateRoom($category, $price, $personNo, $image, $status, $perks) {
    $conn = $this->dbConn();
    $id = $_GET['updateID'];
    $sql = "UPDATE `room` SET `category`=?, `price`=?, `personNo`=?, `image`=?, `status`=?, `perks`=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    // Assuming price and personNo are numeric values, use "d" for double/decimal data type
    $stmt->bind_param("sddsssi", $category, $price, $personNo, $image, $status, $perks, $id);
    $stmt->execute();
}


public function updateCheckIn($checkinDate, $checkoutDate, $reservationDate, $guest, $room, $id) {
    $conn = $this->dbConn();

    // Check if the guest value exists in the guest table
    $sql = "SELECT id FROM guest WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $guest);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Guest value exists, proceed with updating the reservation
        $sql = "UPDATE `reservation` SET `checkinDate`=?, `checkoutDate`=?, `reservationDate`=?, `guest`=?, `room`=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiii", $checkinDate, $checkoutDate, $reservationDate, $guest, $room, $id);
        if ($stmt->execute()) {
            header("Location: updateCheckin.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }  
}



public function register($username,$email,$password,$confrim_password,$user_type){
    $conn = $this->dbConn();
    $sql = "SELECT id FROM cred WHERE email='$email' OR username = '$username'";
    $result = $conn->query($sql);

    if(($result->num_rows > 0) ){
        echo'<script>alert("Email Already, Please use other email")</script>';
    }else{
        if($password != $confrim_password){
            echo'<script>alert("Password not Match")<script>';
    }else{
            $resgister ="INSERT INTO cred (username,email ) VALUES ('$username','$email' )";

            if($conn->query($resgister) == TRUE){
                $register_id = $conn->insert_id;

                $login = "INSERT INTO login (userID,password,user_type) VALUES ('$register_id','$password','$user_type')";
                if($conn->query($login) == TRUE){
                    echo'<script>alert("Please Proceed to login")</script>';
            }   
            }

    }    
}
}

public function login($mail, $pass) {
    $conn = $this->dbConn();
  
    // Ensure to use prepared statements to prevent SQL injection
    $sql = "SELECT cred.id, login.user_type FROM cred INNER JOIN login ON cred.id = login.userID WHERE email = ? AND password = ?";
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    // Bind parameters
    $stmt->bind_param("ss", $mail, $pass);
    // Execute the query
    $stmt->execute();
    // Get the result
    $res = $stmt->get_result();
    // Check if there are rows returned
    if ($res->num_rows > 0) {
        // Fetch the first row
        $row = $res->fetch_assoc();
        // Check the user type
        if ($row['user_type'] == 'admin') {
            $_SESSION['id'] = $row['id'];
            header("Location: adminPanel.php");
            exit();
            
        } elseif ($row['user_type'] == 'guest') {
            $_SESSION['guestID'] = $row['id'];
            header("Location: index.php");
            exit();
        }
    } 
    else {
        // Redirect with message for invalid credentials
        header("Location: login.php?msg=invalid_credentials");
        exit();
    }
}

public function concern($username, $email, $phone_no, $message) {
    $conn = $this->dbConn();
    $sql = "INSERT INTO contact (username, email, phone_no, message) VALUES ('$username', '$email', '$phone_no', '$message')";
    
    // Execute the SQL query
    if ($conn->query($sql)) {
        echo "<script>alert('Your Concern Has been sent')</script>";
    } else {
        echo "<script>alert('Try again')</script>";
    }
}

}