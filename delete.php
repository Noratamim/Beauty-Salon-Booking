<?php
include 'db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "DELETE FROM appointments WHERE appointment_id = $id";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: admin.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    
    header("Location: admin.php");
}
?>