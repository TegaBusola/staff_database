<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Member Information</title>
    <style>
        table {
            width: 80%; /* Set the width of the table */
            margin: 20px auto; /* Center the table on the page */
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center; /* Align content to the center */
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Display a centered and underlined heading -->
<h2><u>Staff Member Information</u></h2>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// SQL query to select all staff members from the database
$sql = "SELECT * FROM staff";
$result = mysqli_query($conn, $sql);

// Check if there are results from the query
if (mysqli_num_rows($result) > 0) {
    // Start building the HTML table
    echo "<table>";
    echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Position</th></tr>"; // Print column headers

    // Loop through each row in the result set
    while($row = mysqli_fetch_assoc($result)) {
        // Display a table row for each staff member
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"] . "</td><td>". $row["Email"] . "</td><td>". $row["Position"] . "</td></tr>";
    }

    // End the HTML table
    echo "</table>";
} else {
    // If there are no results, display a message
    echo "0 results";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
