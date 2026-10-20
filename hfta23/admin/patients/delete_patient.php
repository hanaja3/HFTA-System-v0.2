<?php

require_once "../../config/db.php";

// Get Patient ID

if(!isset($_GET['id'])){

    header("Location: patients.php");
    exit();

}

$patient_id = $_GET['id'];

// Delete Query

$sql = "DELETE FROM patients WHERE patient_id='$patient_id'";

if(mysqli_query($conn, $sql))
{

    echo "<script>

            alert('Patient Record Deleted Successfully.');

            window.location='patients.php';

          </script>";

}
else
{

    echo "<script>

            alert('Error Deleting Patient Record.');

            window.history.back();

          </script>";

}

?>
