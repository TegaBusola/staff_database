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

        form {
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<!-- Display a centered heading -->
<h2>Staff Member Database - Administrative View</h2>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "Remove" button is clicked
    if (isset($_POST['remove'])) {
        $id = $_POST['remove'];

        // Perform the delete query
        $sql = "DELETE FROM staff WHERE ID='$id'";

        // Execute the delete query
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } 
    // Check if the "Update" button is clicked
    elseif (isset($_POST['update'])) {
        $id = $_POST['update'];

        // Redirect to the update_profile.php page with the user ID
        header("Location: update_profile.php?id=$id");
        exit();
    } 
    // Check if the updated information is submitted
    elseif (isset($_POST['updated_first_name']) && isset($_POST['updated_last_name']) && isset($_POST['updated_email']) && isset($_POST['updated_position'])) {
        $id = $_POST['update'];

        // Retrieve updated information from the form
        $updatedFirstName = $_POST['updated_first_name'];
        $updatedLastName = $_POST['updated_last_name'];
        $updatedEmail = $_POST['updated_email'];
        $updatedPosition = $_POST['updated_position'];

        // Perform the update query using prepared statements to prevent SQL injection
        $sql = "UPDATE staff SET FirstName=?, LastName=?, Email=?, Position=? WHERE ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $updatedFirstName, $updatedLastName, $updatedEmail, $updatedPosition, $id);

        // Execute the update query
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Select all staff members from the database
$sql = "SELECT * FROM staff";
$result = mysqli_query($conn, $sql);

// Display the staff members in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Position</th><th>Actions</th></tr>";

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["FirstName"] . "</td>";
        echo "<td>" . $row["LastName"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Position"] . "</td>";
        echo "<td>";

        // Form for removing staff member
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='remove' value='" . $row["ID"] . "'>";
        echo "<input type='submit' value='Remove' onclick='return confirm(\"Are you sure you want to remove this staff member?\")'>";
        echo "</form>";

        // Form for updating staff member
        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='update' value='" . $row["ID"] . "'>";
        echo "<input type='submit' value='Update'>";
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
