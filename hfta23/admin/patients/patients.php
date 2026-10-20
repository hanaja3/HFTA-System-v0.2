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

    <title>Administrator Dashboard | Patients Management</title>

    <link rel="stylesheet" href="../css/dashboard.css">

    <style>

        /* Content */

        .content{

            padding:30px;

        }

        /* Header */

        .page-title{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:20px;

        }

        .page-title h2{

            color:#17324d;

        }

        /* Add Button */

        .add-btn{

            background:#0d6efd;
            color:white;
            text-decoration:none;
            padding:12px 20px;
            border-radius:5px;
            transition:.3s;

        }

        .add-btn:hover{

            background:#0b5ed7;

        }

        /* Table Container */

        .table-container{

            background:#fff;

            padding:20px;

            border-radius:10px;

            box-shadow:0 3px 10px rgba(0,0,0,.15);

        }

        /* Table */

        table{

            width:100%;

            border-collapse:collapse;

        }

        table th{

            background:#17324d;

            color:white;

            padding:15px;

            text-align:center;

        }

        table td{

            padding:15px;

            border-bottom:1px solid #ddd;

            text-align:center;

        }

        table tr:hover{

            background:#f5f5f5;

        }

        /* Action Buttons */

        .action-btn{

            text-decoration:none;

            padding:8px 10px;

            border-radius:5px;

            color:white;

            margin:0 2px;

            display:inline-block;

        }

        .view{

            background:#17a2b8;

        }

        .edit{

            background:#ffc107;

            color:black;

        }

        .delete{

            background:#dc3545;

        }

        .view:hover{

            background:#138496;

        }

        .edit:hover{

            background:#e0a800;

        }

        .delete:hover{

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

            <li><a href="../users/users.php">👤 Staffs</a></li>

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

        <h2>Patients Management</h2>

        <a href="add_patient.php" class="add-btn">+ Add New Patient</a>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>Patient Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Admission Date</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    $sql = "SELECT * FROM patients ORDER BY patient_id DESC";

                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_assoc($result)){

                            echo "

                                <tr>

                                    <td>" . $row['patient_number'] . "</td>
                                    <td>" . $row['first_name'] . "</td>
                                    <td>" . $row['last_name'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['phone_number'] . "</td>
                                    <td>" . $row['patient_status'] . "</td>
                                    <td>" . $row['admission_date'] . "</td>

                                    <td>

                                        <a href='view_patient.php?id=" . $row['patient_id'] . "' class='action-btn view'>View</a>

                                        <a href='edit_patient.php?id=" . $row['patient_id'] . "' class='action-btn edit'>Edit</a>

                                        <a href='delete_patient.php?id=" . $row['patient_id'] . "' class='action-btn delete' onclick=\"return confirm('Are you sure you want to delete this patient record?')\">Delete</a>

                                    </td>

                                </tr>

                            ";

                        }

                    } else {

                        echo "

                            <tr>

                                <td colspan='8'>No Patients Found</td>

                            </tr>

                        ";

                    }

                ?>

            </tbody>

        </table>

    </div>

    </div>

</div>

</div>

</body>

</html>
