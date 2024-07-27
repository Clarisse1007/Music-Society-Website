<?php
require_once('mysql_connect.php');
session_start();

// Check if the user is logged in via the name
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Assuming the user is logged in via their name
$loggedInUserName = $_SESSION['username']; // Adjust as per your session variable

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to database: " . mysqli_connect_error());

// Fetch the student name based on the logged-in user's name
$sql_fetchStudentName = "SELECT name FROM users WHERE name = '$loggedInUserName'";
$result_fetchStudentName = mysqli_query($mysqli, $sql_fetchStudentName);

if ($result_fetchStudentName && mysqli_num_rows($result_fetchStudentName) > 0) {
    $studentData = mysqli_fetch_assoc($result_fetchStudentName);
    $loggedInStudentName = $studentData['name'];

    // Fetch the booking information based on the student name
    $sql_fetchBookings = "SELECT * FROM event_booking WHERE student_name = '$loggedInStudentName'";
    $result_fetchBookings = mysqli_query($mysqli, $sql_fetchBookings);
    
    if (!$result_fetchBookings) {
        die("Error fetching booking information: " . mysqli_error($mysqli));
    }
} else {
    // Handle the case where no student name is found
    die("No student name found for the logged-in user.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Booking Status</title>
    <link rel="stylesheet" type="text/css" href="css/member.css">
    <style>
        h1{
            text-align:center;
        }
        
        .container {
            flex: 3;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .container table th,
        .container table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .container table th {
            background: #4CAF50;
            color: white;
            font-weight: bold;
        }

        .container table td {
            background: #f9f9f9;
        }

        .container table tr:hover td {
            background: #f1f1f1;
        }
    </style>
</head>
<body>
    <header>
        <div class="navlist">
            <div class="logo">
                <img src="logo.png" alt="logo" width="200px"/>
            </div>
            <div class="title">
                <h3>Welcome to Member Page</h3>
            </div>
            <nav class="head">
                <ul>
                    <li><a href="member.php">Home</a></li>
                    <li><a href="home.php">Log Out</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="main-content">
        <div class="side-navigationlist">
            <nav class="side">
                <table>
                    <tr><td><a href="searchNsort_event.php">Search And Sorting Event</a></td></tr>
                    <tr><td><a href="showeventforbooking.php">Booking For Event</a></td></tr>
                    <tr><td><a href="showcancelbooking.php">Cancel Booking</a></td></tr>
                    <tr><td><a href="#">Cancel Registration</a></td></tr>
                    <tr><td><a href="viewbookingstatus.php">View Booking Status</a></td></tr>
                    <tr><td><a href="ticket.php">Print Ticket/Receipt/QR code</a></td></tr>
                    <tr><td><a href="feedbackform.php">Feedback Form</a></td></tr>
                </table>
            </nav>
        </div>
        
        <div class="container">
            <h1>Booking Status</h1>
            <table>
                <tr>
                    <th>Event Title</th>
                    <th>Row</th>
                    <th>Seat</th>
                    <th>Status</th>
                </tr>
                <?php
                if (mysqli_num_rows($result_fetchBookings) > 0) {
                    while ($booking = mysqli_fetch_assoc($result_fetchBookings)) {
                        echo "<tr>
                                <td>{$booking['event_title']}</td>
                                <td>{$booking['row_selected']}</td>
                                <td>{$booking['seat_selected']}</td>
                                <td>{$booking['booking_status']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No bookings found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
    
    <footer>
        <div class="contactUs">
            <h3>Contact us</h3>
            <a href="https://www.facebook.com/profile.php?id=61559349223136&mibextid=ZbWKwL"><img src="fb.png" alt="fb" width="100px" height="auto"/></a>
            <a href="https://www.instagram.com/musico_club?igsh=dnVlMWdmMmliYnVx"><img src="ig.png" alt="ig" width="100px" height="auto"/></a>
        </div>
    </footer>

</body>
</html>
