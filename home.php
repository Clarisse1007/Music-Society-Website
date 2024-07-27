<?php
    session_start();
    $_SESSION['authenticate'] = "approved";
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Home 1</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/viewevent.css">
</head>

<body>
    <header>
        <div class="navlist">
            <div class="logo">
                <img src="logo.png" alt="logo" width="200px"/>
            </div>

            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="home.php">Events</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">Log In/Register</a>
                        <div class="dropdown-content">
                            <h2>Welcome back!!</h2>
                            <p><a href="login.php">Log In</a></p>
                            <div class="breaker">
                                <div><hr class="divider"></div>
                            </div>
                            <h4>Register for member to get more information!</h4>
                            <p><a href="register.php">Register</a></p>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <?php
        require_once('mysql_connect.php');
        $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)or die ("Could not connect to database: " . mysqli_connect_error() );
        $sql_readRecord = "SELECT * FROM add_event";
        $result_readRecord = mysqli_query($mysqli, $sql_readRecord);  

        if ($result_readRecord && mysqli_num_rows($result_readRecord) > 0) {
            while ($row = mysqli_fetch_assoc($result_readRecord)) {
                echo '<div class="event-container">';
                    echo '<div class="event-image"><img src="' . $row['event_image'] . '" alt="Event Image"></div>'; // Image above
                        echo '<div class="event-details">';
                        echo '<table>';
                        echo '<tr><th>Event Title</th><td>' . $row['event_title'] . '</td></tr>';
                        echo '<tr><th>Description</th><td>' . $row['event_description'] . '</td></tr>';
                        echo '<tr><th>Date & Time</th><td>' . $row['event_date_time'] . '</td></tr>';
                        echo '<tr><th>Location</th><td>' . $row['event_location'] . '</td></tr>';
                        echo '</table>';
                        echo '</div>'; // Closing event-details
                echo '</div>'; // Closing event-container
            }
        } else {
            echo 'Failed to display event';
        }
        mysqli_close($mysqli);
    ?>
    
    <footer>
        <div class="contactUs">
            <h3>Contact us</h3>
            <a href="https://www.facebook.com/profile.php?id=61559349223136&mibextid=ZbWKwL"><img src="fb.png" alt="fb" width="100px" height="auto"/></a>
            <a href="https://www.instagram.com/musico_club?igsh=dnVlMWdmMmliYnVx"><img src="ig.png" alt="ig" width="100px" height="auto"/></a>
        </div>
    </footer>

</body>
</html>
