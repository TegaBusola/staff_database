<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<!-- Display a centered heading -->
<h1>Edit Staff Details</h1>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// Initialize error message variable
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $position = $_POST["position"];

    // Validate if all fields are filled
    if (empty($firstName) || empty($lastName) || empty($email) || empty($position)) {
        $error_message = "Please complete all fields of the form before submitting";
    } else {
        
        $id = mysqli_real_escape_string($conn, $id);
        $firstName = mysqli_real_escape_string($conn, $firstName);
        $lastName = mysqli_real_escape_string($conn, $lastName);
        $email = mysqli_real_escape_string($conn, $email);
        $position = mysqli_real_escape_string($conn, $position);

        // Update staff member information in the database
        $sqlUpdate = "UPDATE staff SET 
                      FirstName='$firstName', 
                      LastName='$lastName', 
                      Email='$email', 
                      Position='$position' 
                      WHERE ID='$id'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);

        // Check if the update was successful
        if ($resultUpdate) {
            echo "Staff member information updated successfully!";
        } else {
            echo "Error updating information: " . mysqli_error($conn);
        }
    }
}

// Display staff members for selection
$sqlSelect = "SELECT * FROM staff";
$resultSelect = mysqli_query($conn, $sqlSelect);
?>

<!-- Display error message if any -->
<?php if (!empty($error_message)) : ?>
    <p class="error"><?php echo $error_message; ?></p>
<?php endif; ?>

<!-- Display staff members for selection -->
<?php if (mysqli_num_rows($resultSelect) > 0) : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="id">Select Staff Member:</label>
        <select name="id" required>
            <?php while ($row = mysqli_fetch_assoc($resultSelect)) : ?>
                <option value="<?php echo $row['ID']; ?>"><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="position">Position:</label>
        <select name="position" required>
            <option value="Lecturer">Lecturer</option>
            <option value="Senior Lecturer">Senior Lecturer</option>
            <option value="Reader">Reader</option>
            <option value="Professor">Professor</option>
        </select>

        <input type="submit" value="Update Staff Details">
    </form>
<?php else : ?>
    <p>No staff members found in the database.</p>
<?php endif; ?>

</body>
</html>
