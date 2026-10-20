<?php

session_start();

require_once "../../config/db.php";

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

if(!isset($_SESSION['user_id'])){

    header("Location: ../../auth-pages/login.php");

    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Administrator Dashboard | View Patient</title>

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

        /* Details Container */

        .details-container{

            width:70%;

            background:#fff;

            margin:auto;

            padding:30px;

            border-radius:10px;

            box-shadow:0 3px 10px rgba(0,0,0,.15);

        }

        /* Detail Row */

        .detail-row{

            margin-bottom:20px;

            padding-bottom:15px;

            border-bottom:1px solid #ddd;

        }

        .detail-row:last-child{

            border-bottom:none;

        }

        .detail-label{

            font-weight:bold;

            color:#17324d;

            font-size:14px;

        }

        .detail-value{

            color:#333;

            font-size:16px;

            margin-top:5px;

        }

        /* Action Buttons */

        .action-buttons{

            margin-top:30px;

            text-align:center;

        }

        .action-btn{

            text-decoration:none;

            padding:12px 25px;

            border-radius:5px;

            color:white;

            margin:0 10px;

            display:inline-block;

            transition:.3s;

        }

        .edit-btn{

            background:#ffc107;

            color:black;

        }

        .edit-btn:hover{

            background:#e0a800;

        }

        .delete-btn{

            background:#dc3545;

        }

        .delete-btn:hover{

            background:#bb2d3b;

        }

        .back-btn{

            background:#6c757d;

        }

        .back-btn:hover{

            background:#5a6268;

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

                <h2>Patient Details - <?php echo $patient['first_name'] . " " . $patient['last_name']; ?></h2>

            </div>

            <div class="details-container">

                <div class="detail-row">

                    <div class="detail-label">Patient Number</div>

                    <div class="detail-value"><?php echo $patient['patient_number']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Full Name</div>

                    <div class="detail-value"><?php echo $patient['first_name'] . " " . $patient['middle_name'] . " " . $patient['last_name']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Gender</div>

                    <div class="detail-value"><?php echo $patient['gender']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Date of Birth</div>

                    <div class="detail-value"><?php echo $patient['date_of_birth']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Address</div>

                    <div class="detail-value"><?php echo $patient['address']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Phone Number</div>

                    <div class="detail-value"><?php echo $patient['phone_number']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Email Address</div>

                    <div class="detail-value"><?php echo $patient['email']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Blood Type</div>

                    <div class="detail-value"><?php echo $patient['blood_type']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Allergies</div>

                    <div class="detail-value"><?php echo $patient['allergies']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Medical History</div>

                    <div class="detail-value"><?php echo $patient['medical_history']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Current Medications</div>

                    <div class="detail-value"><?php echo $patient['current_medications']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Admission Date</div>

                    <div class="detail-value"><?php echo $patient['admission_date']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Discharge Date</div>

                    <div class="detail-value"><?php echo $patient['discharge_date'] ? $patient['discharge_date'] : "Not Yet Discharged"; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Patient Status</div>

                    <div class="detail-value"><?php echo $patient['patient_status']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Emergency Contact Name</div>

                    <div class="detail-value"><?php echo $patient['emergency_contact_name']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Emergency Contact Number</div>

                    <div class="detail-value"><?php echo $patient['emergency_contact_number']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Additional Notes</div>

                    <div class="detail-value"><?php echo $patient['notes']; ?></div>

                </div>

                <div class="detail-row">

                    <div class="detail-label">Date Created</div>

                    <div class="detail-value"><?php echo $patient['created_at']; ?></div>

                </div>

                <div class="action-buttons">

                    <a href="edit_patient.php?id=<?php echo $patient['patient_id']; ?>" class="action-btn edit-btn">Edit Patient</a>

                    <a href="delete_patient.php?id=<?php echo $patient['patient_id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this patient record?')">Delete Patient</a>

                    <a href="patients.php" class="action-btn back-btn">Back to Patients List</a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
