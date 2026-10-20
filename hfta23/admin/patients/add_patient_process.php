<?php

require_once "../../config/db.php";

// Get Form Data

$patient_number = $_POST['patient_number'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$blood_type = $_POST['blood_type'];
$allergies = $_POST['allergies'];
$medical_history = $_POST['medical_history'];
$current_medications = $_POST['current_medications'];
$admission_date = $_POST['admission_date'];
$emergency_contact_name = $_POST['emergency_contact_name'];
$emergency_contact_number = $_POST['emergency_contact_number'];
$patient_status = $_POST['patient_status'];
$notes = $_POST['notes'];

// Insert Query

$sql = "INSERT INTO patients(

    patient_number,
    first_name,
    middle_name,
    last_name,
    gender,
    date_of_birth,
    address,
    phone_number,
    email,
    blood_type,
    allergies,
    medical_history,
    current_medications,
    admission_date,
    emergency_contact_name,
    emergency_contact_number,
    patient_status,
    notes

) VALUES(

    '$patient_number',
    '$first_name',
    '$middle_name',
    '$last_name',
    '$gender',
    '$date_of_birth',
    '$address',
    '$phone_number',
    '$email',
    '$blood_type',
    '$allergies',
    '$medical_history',
    '$current_medications',
    '$admission_date',
    '$emergency_contact_name',
    '$emergency_contact_number',
    '$patient_status',
    '$notes'

)";

if(mysqli_query($conn, $sql))
{

    echo "<script>

            alert('Patient Added Successfully.');

            window.location='patients.php';

          </script>";

}
else
{

    echo "<script>

            alert('Error Adding Patient.');

            window.history.back();

          </script>";

}

?>
