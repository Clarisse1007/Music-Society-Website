<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/viewevent.css">
    <title>Admin View</title>
</head>
<body>
    <h2>Events</h2>
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
                
                // Delete button
                echo '<form action="deleteevent.php" method="POST">';
                echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
                echo '<button type="submit">Delete Event</button>';
                echo '</form>';
                
                echo '<form action="updateevent.php" method="POST">';
                echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
                echo '<button type="submit">Update Event</button>';
                echo '</form>';
                
                echo '</div>'; // Closing event-details
                echo '</div>'; // Closing event-container
            }

            echo '<p>' . mysqli_num_rows($result_readRecord) . ' record(s) returned. [<a href="insert-event.php">Insert Event</a>]</p>';
        } else {
            echo '<p>0 results</p>';
        }

        mysqli_close($mysqli);
    ?>
</body>
</html>