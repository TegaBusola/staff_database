<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff by Departments</title>
    <style>
        table {
            width: 80%; /* Set the width of the table */
            margin: 20px auto; /* Center the table on the page */
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center; /* Align content to the center */
        }
        h2 {
            text-align: center;
            text-decoration: underline; /* Underline the heading */
        }
        form {
            text-align: center; /* Align the form to the center */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Display a centered and underlined heading -->
<h2>Staff by Departments</h2>

<!-- Filter form moved to the top -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Dropdown menu to select position filter -->
    <label for="position_filter">Filter by Position:</label>
    <select name="position_filter" id="position_filter">
        <option value="all">All Positions</option>
        <!-- Drop down option of positions -->
        <option value="Senior Lecturer">Senior Lecturer</option>
        <option value="Lecturer">Lecturer</option>
        <option value="Professor">Professor</option>
        <option value="Reader">Reader</option>
        <!-- Add more options as needed -->
    </select>
    <!-- Submit button to trigger form submission -->
    <input type="submit" value="Filter">
</form>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected filter value
    $filter = $_POST["position_filter"];

    // Construct SQL query based on the filter value
    if ($filter == "all") {
        $sql = "SELECT * FROM staff";
    } else {
        $sql = "SELECT * FROM staff WHERE Position = '$filter'";
    }

    // Execute the query
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
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
