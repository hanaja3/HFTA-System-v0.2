<?php

session_start();

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth-pages/login.php");
    exit();
}

// Get Total Patients Count
$total_patients_query = "SELECT COUNT(*) AS total FROM patients";
$total_patients_result = mysqli_query($conn, $total_patients_query);
$total_patients = mysqli_fetch_assoc($total_patients_result)['total'];

// Get Admitted Patients Count
$admitted_patients_query = "SELECT COUNT(*) AS admitted FROM patients WHERE patient_status = 'Admitted'";
$admitted_patients_result = mysqli_query($conn, $admitted_patients_query);
$admitted_patients = mysqli_fetch_assoc($admitted_patients_result)['admitted'];

// Get Discharged Patients Count
$discharged_patients_query = "SELECT COUNT(*) AS discharged FROM patients WHERE patient_status = 'Discharged'";
$discharged_patients_result = mysqli_query($conn, $discharged_patients_query);
$discharged_patients = mysqli_fetch_assoc($discharged_patients_result)['discharged'];

// Get Total Staff Count
$total_staff_query = "SELECT COUNT(*) AS staff FROM users WHERE role != 'Patient'";
$total_staff_result = mysqli_query($conn, $total_staff_query);
$total_staff = mysqli_fetch_assoc($total_staff_result)['staff'];

// Get Recent Patient Admissions
$recent_patients_query = "SELECT patient_id, first_name, last_name, patient_number, admission_date, patient_status FROM patients ORDER BY admission_date DESC LIMIT 5";
$recent_patients_result = mysqli_query($conn, $recent_patients_query);

?>
<!DOCTYPE html>

<html>

<head>

    <title>Home For the Age - Administrator Dashboard</title>

    <link rel="stylesheet" href="css/dashboard.css">

    <style>

        .content{
            padding:30px;
        }

        .cards {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card {
            background:#fff;
            border-radius:10px;
            padding:25px;
            box-shadow:0 3px 10px rgba(0,0,0,.15);
            border-left:5px solid #0d6efd;
        }

        .card h3 {
            color:#17324d;
            margin-bottom:10px;
            font-size:14px;
            text-transform:uppercase;
        }

        .card h1 {
            color:#17324d;
            font-size:36px;
            margin:0;
        }

        .status-admitted {
            background:#d4edda;
            color:#155724;
            padding:5px 10px;
            border-radius:3px;
            font-size:12px;
            font-weight:bold;
        }

        .status-discharged {
            background:#f8d7da;
            color:#721c24;
            padding:5px 10px;
            border-radius:3px;
            font-size:12px;
            font-weight:bold;
        }

        .status-inactive {
            background:#e2e3e5;
            color:#383d41;
            padding:5px 10px;
            border-radius:3px;
            font-size:12px;
            font-weight:bold;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- Sidebar -->

    <div class="sidebar">

        <h2>HFTA</h2>

        <ul>

            <li><a href="dashboard.php">🏠 Dashboard</a></li>

            <li><a href="patients/patients.php">👥 Patients</a></li>

            <li><a href="users/users.php">👨‍⚕️ Staff</a></li>

            <li><a href="../auth-pages/logout.php">🚪 Logout</a></li>

        </ul>

    </div>

    <!-- Main Content -->

    <div class="main">

        <!-- Navbar -->

        <div class="navbar">

            <h2>Home For the Age - Patient Management System</h2>

            <div class="profile">

                <img src="../uploads/<?php echo $_SESSION['photo']; ?>">

                <span><?php echo $_SESSION['fullname']; ?></span>

            </div>

        </div>

        <!-- Dashboard Content -->

        <div class="content">

            <!-- Statistics Cards -->

            <div class="cards">

                <div class="card">

                    <h3>Total Patients</h3>

                    <h1><?php echo $total_patients; ?></h1>

                </div>

                <div class="card">

                    <h3>Currently Admitted</h3>

                    <h1><?php echo $admitted_patients; ?></h1>

                </div>

                <div class="card">

                    <h3>Discharged Patients</h3>

                    <h1><?php echo $discharged_patients; ?></h1>

                </div>

                <div class="card">

                    <h3>Total Staff Members</h3>

                    <h1><?php echo $total_staff; ?></h1>

                </div>

            </div>

            <!-- Recent Patient Admissions Table -->

            <div class="table-container">

                <h2>Recent Patient Admissions</h2>

                <table>

                    <tr>

                        <th>Patient Number</th>

                        <th>Patient Name</th>

                        <th>Admission Date</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                    <?php

                    while ($row = mysqli_fetch_assoc($recent_patients_result)) {

                        $status_class = "status-" . strtolower($row['patient_status']);

                        echo "<tr>";

                        echo "<td>" . $row['patient_number'] . "</td>";

                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";

                        echo "<td>" . date('M d, Y', strtotime($row['admission_date'])) . "</td>";

                        echo "<td><span class='" . $status_class . "'>" . $row['patient_status'] . "</span></td>";

                        echo "<td><a href='patients/view_patient.php?patient_id=" . $row['patient_id'] . "' style='color: #0d6efd; text-decoration: none; font-weight: bold;'>View Details</a></td>";

                        echo "</tr>";

                    }

                    ?>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>