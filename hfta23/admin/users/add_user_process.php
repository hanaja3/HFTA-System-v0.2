<?php

session_start();

require_once "../../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth-pages/login.php");
    exit();
}

if($_SESSION['role'] !== 'Administrator'){
    echo "<script>
            alert('Only administrators can add new users.');
            window.location='users.php';
          </script>";
    exit();
}

// Get Form Data

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

// Upload Photo

$photo = $_FILES['photo']['name'];
$temp = $_FILES['photo']['tmp_name'];

move_uploaded_file($temp, "../../uploads/" . $photo);

// Insert Query

$sql = "INSERT INTO users(fullname, photo, email, password, role)

VALUES('$fullname','$photo','$email','$password','$role')";

if(mysqli_query($conn,$sql))
{

    echo "<script>

            alert('User Added Successfully.');

            window.location='users.php';

          </script>";

}
else
{

    echo "<script>

            alert('Error Adding User.');

            window.history.back();

          </script>";

}

?>