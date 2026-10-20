<?php

session_start();

include "../config/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    $user = mysqli_fetch_assoc($result);

    // Check password with bcrypt (new) or MD5 (old compatibility)
    $password_valid = password_verify($password, $user['password']) || md5($password) == $user['password'];

    if($password_valid){

        $_SESSION['user_id'] = $user['user_id'];

        $_SESSION['fullname'] = $user['fullname'];

        $_SESSION['photo'] = $user['photo'];

        $_SESSION['role'] = $user['role'];

        // Redirect based on user role

        if($user['role'] == "Administrator" || $user['role'] == "Nurse" || $user['role'] == "Doctor" || $user['role'] == "Receptionist"){

            header("Location: ../admin/dashboard.php");

        }

        else{

            // Fallback for any other role
            header("Location: ../admin/dashboard.php");

        }

        exit();

    }

    else{

        echo "<script> alert('Incorrect Password!');
        
        window.location='login.php';

        </script>";
    }

}

else{

    echo "<script>alert('Email not found!');

    window.location='login.php';

    </script>";

}

?>