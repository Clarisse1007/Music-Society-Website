<?php
// Database connection
require_once 'mysql_connect.php';
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to database: " . mysqli_connect_error());
// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $ticketowner = $_SESSION['username'];

    // Query to fetch booking information and join with event information
    $sql = "SELECT eb.*, ae.event_date_time, ae.event_location FROM event_booking eb
            JOIN add_event ae ON eb.event_title = ae.event_title
            WHERE eb.student_name = '$ticketowner'";
    $result = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) > 0) {
        $bookingData = mysqli_fetch_assoc($result);

        // Get event information based on the booking
        $eventTitle = $bookingData['event_title'];
        $eventDateTime = $bookingData['event_date_time'];
        $location = $bookingData['event_location'];
        $rowSelected = isset($bookingData['row_selected']) ? $bookingData['row_selected'] : "N/A";
        $seatSelected = isset($bookingData['seat_selected']) ? $bookingData['seat_selected'] : "N/A";
        $studentName = $bookingData['student_name'];

        
        // Construct ticket information
        $ticketInfo = "Student Name: $studentName<br>";
        $ticketInfo .= "Event Title: $eventTitle<br>";
        $ticketInfo .= "Date & Time: $eventDateTime<br>";
        $ticketInfo .= "Location: $location<br>";
        $ticketInfo .= "Seat: Row $rowSelected, Seat $seatSelected<br>";


        // Close database connection
        mysqli_close($mysqli);
    } else {
        echo "No booking found for $ticketowner";
        exit();
    }
} else {
    echo "User not logged in";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/member.css">
    <title>Event Ticket</title>
    <style>
        .main-content {
            display: flex;
            justify-content: space-between;
        }

        .container {
            flex-grow: 1;
            padding: 20px;
        }

        .ticket-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 70%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the container horizontally */
            align-items: center; /* Align items in the center */
        }

        .ticket-info {
            margin-bottom: 20px;

            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .qr-code {
            display: block;
            margin: 0 auto;
            max-width: 100%;
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
            <div class="ticket-container">
                <h2>Event Ticket</h2><br>
                <div class="ticket-info">
                    <?php echo $ticketInfo; ?>
                </div>
                <img class="qr-code" src="ticket_qr.png" alt="Ticket QR Code">
            </div>
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
