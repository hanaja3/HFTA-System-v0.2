<?php

require_once "../../config/db.php";

// Get Form Data

$patient_id = $_POST['patient_id'];
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
$discharge_date = $_POST['discharge_date'];
$emergency_contact_name = $_POST['emergency_contact_name'];
$emergency_contact_number = $_POST['emergency_contact_number'];
$patient_status = $_POST['patient_status'];
$notes = $_POST['notes'];

// Update Query

$sql = "UPDATE patients SET

    patient_number='$patient_number',
    first_name='$first_name',
    middle_name='$middle_name',
    last_name='$last_name',
    gender='$gender',
    date_of_birth='$date_of_birth',
    address='$address',
    phone_number='$phone_number',
    email='$email',
    blood_type='$blood_type',
    allergies='$allergies',
    medical_history='$medical_history',
    current_medications='$current_medications',
    admission_date='$admission_date',
    discharge_date='$discharge_date',
    emergency_contact_name='$emergency_contact_name',
    emergency_contact_number='$emergency_contact_number',
    patient_status='$patient_status',
    notes='$notes'

WHERE patient_id='$patient_id'";

if(mysqli_query($conn, $sql))
{

    echo "<script>

            alert('Patient Updated Successfully.');

            window.location='patients.php';

          </script>";

}
else
{

    echo "<script>

            alert('Error Updating Patient.');

            window.history.back();

          </script>";

}

?>
