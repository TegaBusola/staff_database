<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Content</title>
    <style>
        body {
            text-align: center;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 80%; /* Adjusted width for better visibility */
            margin: 20px auto; /* Center the table */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center; /* Center-align table content */
        }
    </style>
</head>
<body>

<!-- Display a centered and underlined heading -->
<h2>Delete Staff Member From Database</h2>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// Check if the form is submitted and the 'remove' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove'])) {
    $id = $_POST['remove']; 

    // Perform the delete query
    $sql = "DELETE FROM staff WHERE ID='$id'";

    // Check if the query was successful
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Retrieve all staff members from the database
$sql = "SELECT * FROM staff";
$result = mysqli_query($conn, $sql);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Position</th><th>Action</th></tr>";

    // Loop through each row of the result set
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["FirstName"] . "</td>";
        echo "<td>" . $row["LastName"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Position"] . "</td>";
        echo "<td>";
        echo "<form action='' method='post'>"; // Leave action empty
        echo "<input type='hidden' name='remove' value='" . $row["ID"] . "'>";
        echo "<input type='submit' value='Remove' onclick='return confirm(\"Are you sure you want to remove this staff member?\")'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
