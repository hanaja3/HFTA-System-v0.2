<?php

session_start();

require_once "../../config/db.php";

if(!isset($_SESSION['user_id'])){

    header("Location: ../../auth-pages/login.php");

    exit();

}

if(!isset($_GET['id'])){

    header("Location: patients.php");
    exit();

}

$id = $_GET['id'];

$sql = "SELECT * FROM patients WHERE patient_id='$id'";

$result = mysqli_query($conn, $sql);

$patient = mysqli_fetch_assoc($result);

if(!$patient){

    header("Location: patients.php");
    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Administrator Dashboard | Edit Patient</title>

    <link rel="stylesheet" href="../css/dashboard.css">

    <style>

        /* Content */
.content{
    padding:30px;
}

/* Page Title */
.page-title{
    margin-bottom:25px;
}

.page-title h2{
    color:#17324d;
    font-size:30px;
}

/* Form Container */
.form-container{
    width:70%;
    background:#fff;
    margin:auto;
    padding:30px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,.15);
}

/* Form Group */
.form-group{
    margin-bottom:20px;
}

/* Label */
.form-group label{
    display:block;
    font-weight:bold;
    margin-bottom:8px;
    color:#17324d;
}

/* Input Fields */
.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:5px;
    font-size:16px;
    font-family:Arial, sans-serif;
}

.form-group textarea{
    resize:vertical;
    min-height:80px;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border:1px solid #0d6efd;
    outline:none;
}

/* Buttons */
.button-group{
    margin-top:30px;
}

.save-btn{
    background:#198754;
    color:#fff;
    padding:12px 25px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

.save-btn:hover{
    background:#157347;
}

.cancel-btn{
    background:#dc3545;
    color:#fff;
    padding:12px 25px;
    text-decoration:none;
    border-radius:5px;
    margin-left:10px;
}

.cancel-btn:hover{
    background:#bb2d3b;
}

    </style>

</head>

<body>

<div class="container">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>HFTA</h2>

        <ul>

            <li><a href="../dashboard.php">🏠 Dashboard</a></li>

            <li><a href="../users/users.php">👤 Users</a></li>

            <li><a href="../patients/patients.php">🏥 Patients</a></li>

            <li><a href="../../auth-pages/logout.php">🚪 Logout</a></li>

        </ul>

    </div>

    <!-- Main Content -->

    <div class="main">

        <!-- Navbar -->

        <div class="navbar">

            <h2>Administrator Dashboard</h2>

            <div class="profile">

                <img src="../../uploads/<?php echo $_SESSION['photo']; ?>">

                <span>

                    <?php echo $_SESSION['fullname']; ?>

                </span>

            </div>

        </div>
    
        <div class="content">

    <div class="page-title">

        <h2>Edit Patient Information</h2>

    </div>

    <div class="form-container">

        <form action="edit_patient_process.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">

            <div class="form-group">

                <label>Patient Number</label>

                <input type="text" name="patient_number" value="<?php echo $patient['patient_number']; ?>" required>

            </div>

            <div class="form-group">

                <label>First Name</label>

                <input type="text" name="first_name" value="<?php echo $patient['first_name']; ?>" required>

            </div>

            <div class="form-group">

                <label>Middle Name</label>

                <input type="text" name="middle_name" value="<?php echo $patient['middle_name']; ?>">

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <input type="text" name="last_name" value="<?php echo $patient['last_name']; ?>" required>

            </div>

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="Male" <?php echo ($patient['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>

                    <option value="Female" <?php echo ($patient['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>

                    <option value="Other" <?php echo ($patient['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>

                </select>

            </div>

            <div class="form-group">

                <label>Date of Birth</label>

                <input type="date" name="date_of_birth" value="<?php echo $patient['date_of_birth']; ?>" required>

            </div>

            <div class="form-group">

                <label>Address</label>

                <textarea name="address"><?php echo $patient['address']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Phone Number</label>

                <input type="text" name="phone_number" value="<?php echo $patient['phone_number']; ?>" required>

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input type="email" name="email" value="<?php echo $patient['email']; ?>">

            </div>

            <div class="form-group">

                <label>Blood Type</label>

                <select name="blood_type">

                    <option value="" <?php echo ($patient['blood_type'] == '') ? 'selected' : ''; ?>>Select Blood Type</option>

                    <option value="A+" <?php echo ($patient['blood_type'] == 'A+') ? 'selected' : ''; ?>>A+</option>

                    <option value="A-" <?php echo ($patient['blood_type'] == 'A-') ? 'selected' : ''; ?>>A-</option>

                    <option value="B+" <?php echo ($patient['blood_type'] == 'B+') ? 'selected' : ''; ?>>B+</option>

                    <option value="B-" <?php echo ($patient['blood_type'] == 'B-') ? 'selected' : ''; ?>>B-</option>

                    <option value="O+" <?php echo ($patient['blood_type'] == 'O+') ? 'selected' : ''; ?>>O+</option>

                    <option value="O-" <?php echo ($patient['blood_type'] == 'O-') ? 'selected' : ''; ?>>O-</option>

                    <option value="AB+" <?php echo ($patient['blood_type'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>

                    <option value="AB-" <?php echo ($patient['blood_type'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>

                </select>

            </div>

            <div class="form-group">

                <label>Allergies</label>

                <textarea name="allergies"><?php echo $patient['allergies']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Medical History</label>

                <textarea name="medical_history"><?php echo $patient['medical_history']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Current Medications</label>

                <textarea name="current_medications"><?php echo $patient['current_medications']; ?></textarea>

            </div>

            <div class="form-group">

                <label>Admission Date</label>

                <input type="date" name="admission_date" value="<?php echo $patient['admission_date']; ?>" required>

            </div>

            <div class="form-group">

                <label>Discharge Date</label>

                <input type="date" name="discharge_date" value="<?php echo $patient['discharge_date']; ?>">

            </div>

            <div class="form-group">

                <label>Emergency Contact Name</label>

                <input type="text" name="emergency_contact_name" value="<?php echo $patient['emergency_contact_name']; ?>">

            </div>

            <div class="form-group">

                <label>Emergency Contact Number</label>

                <input type="text" name="emergency_contact_number" value="<?php echo $patient['emergency_contact_number']; ?>">

            </div>

            <div class="form-group">

                <label>Patient Status</label>

                <select name="patient_status" required>

                    <option value="Admitted" <?php echo ($patient['patient_status'] == 'Admitted') ? 'selected' : ''; ?>>Admitted</option>

                    <option value="Discharged" <?php echo ($patient['patient_status'] == 'Discharged') ? 'selected' : ''; ?>>Discharged</option>

                    <option value="Inactive" <?php echo ($patient['patient_status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>

                </select>

            </div>

            <div class="form-group">

                <label>Additional Notes</label>

                <textarea name="notes"><?php echo $patient['notes']; ?></textarea>

            </div>

            <div class="button-group">

                <button type="submit" class="save-btn">Update Patient</button>

                <a href="patients.php" class="cancel-btn">Cancel</a>

            </div>

        </form>

    </div>

    </div>

</div>

</div>

</body>

</html>
