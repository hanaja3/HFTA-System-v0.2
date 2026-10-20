<?php

session_start();

require_once "../../config/db.php";

if(!isset($_SESSION['user_id'])){

    header("Location: ../../auth-pages/login.php");

    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Administrator Dashboard | Add New Patient</title>

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

        <h2>Add New Patient</h2>

    </div>

    <div class="form-container">

        <form action="add_patient_process.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">

                <label>Patient Number</label>

                <input type="text" name="patient_number" placeholder="Enter Patient Number (Example: P001)" required>

            </div>

            <div class="form-group">

                <label>First Name</label>

                <input type="text" name="first_name" placeholder="Enter First Name" required>

            </div>

            <div class="form-group">

                <label>Middle Name</label>

                <input type="text" name="middle_name" placeholder="Enter Middle Name (Optional)">

            </div>

            <div class="form-group">

                <label>Last Name</label>

                <input type="text" name="last_name" placeholder="Enter Last Name" required>

            </div>

            <div class="form-group">

                <label>Gender</label>

                <select name="gender" required>

                    <option value="">Select Gender</option>

                    <option value="Male">Male</option>

                    <option value="Female">Female</option>

                    <option value="Other">Other</option>

                </select>

            </div>

            <div class="form-group">

                <label>Date of Birth</label>

                <input type="date" name="date_of_birth" required>

            </div>

            <div class="form-group">

                <label>Address</label>

                <textarea name="address" placeholder="Enter Full Address"></textarea>

            </div>

            <div class="form-group">

                <label>Phone Number</label>

                <input type="text" name="phone_number" placeholder="Enter Phone Number" required>

            </div>

            <div class="form-group">

                <label>Email Address</label>

                <input type="email" name="email" placeholder="Enter Email Address">

            </div>

            <div class="form-group">

                <label>Blood Type</label>

                <select name="blood_type">

                    <option value="">Select Blood Type</option>

                    <option value="A+">A+</option>

                    <option value="A-">A-</option>

                    <option value="B+">B+</option>

                    <option value="B-">B-</option>

                    <option value="O+">O+</option>

                    <option value="O-">O-</option>

                    <option value="AB+">AB+</option>

                    <option value="AB-">AB-</option>

                </select>

            </div>

            <div class="form-group">

                <label>Allergies</label>

                <textarea name="allergies" placeholder="List any known allergies (Example: Penicillin, Peanuts, etc.)"></textarea>

            </div>

            <div class="form-group">

                <label>Medical History</label>

                <textarea name="medical_history" placeholder="Enter relevant medical history"></textarea>

            </div>

            <div class="form-group">

                <label>Current Medications</label>

                <textarea name="current_medications" placeholder="List current medications and dosages"></textarea>

            </div>

            <div class="form-group">

                <label>Admission Date</label>

                <input type="date" name="admission_date" required>

            </div>

            <div class="form-group">

                <label>Emergency Contact Name</label>

                <input type="text" name="emergency_contact_name" placeholder="Enter Emergency Contact Full Name">

            </div>

            <div class="form-group">

                <label>Emergency Contact Number</label>

                <input type="text" name="emergency_contact_number" placeholder="Enter Emergency Contact Phone Number">

            </div>

            <div class="form-group">

                <label>Patient Status</label>

                <select name="patient_status" required>

                    <option value="Admitted">Admitted</option>

                    <option value="Discharged">Discharged</option>

                    <option value="Inactive">Inactive</option>

                </select>

            </div>

            <div class="form-group">

                <label>Additional Notes</label>

                <textarea name="notes" placeholder="Enter any additional notes about the patient"></textarea>

            </div>

            <div class="button-group">

                <button type="submit" class="save-btn">Add Patient</button>

                <a href="patients.php" class="cancel-btn">Cancel</a>

            </div>

        </form>

    </div>

    </div>

</div>

</div>

</body>

</html>
