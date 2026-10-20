<?php

include "../config/db.php";


$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];


$photo = $_FILES['photo']['name'];
$temp_name = $_FILES['photo']['tmp_name'];

// Generate Unique Filename

$photo_name = time() . "_" . $photo;

// Destination Folder

$folder = "../uploads/" . $photo_name;

// Move Uploaded File

move_uploaded_file($temp_name, $folder);

// Save to Database

$sql = "INSERT INTO users(
fullname,
photo,
email,
password,
role
)

VALUES(
'$fullname',
'$photo_name',
'$email',
'$password',
'$role'
)";

if(mysqli_query($conn,$sql)){

    echo "
    <script>
    alert('Registration Successful!');
    window.location='login.php';
    </script>

    ";

}
else{

    echo "
    <script>
    alert('Registration Failed!');
    window.location='register.php';
    </script>

    ";

}

?>