<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Staff Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center; /* Center the text within the body */
        }
        h2 {
            text-align: center;
            text-decoration: underline; /* Underline the heading */
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

<!-- Display a centered and underlined heading -->
<h2>Add New Staff Member</h2>

<?php
// Include the PHP file containing the database connection
include 'sqlconnection.php';

// Initialize error message variable
$error_message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $position = $_POST["position"];

    // Validate if all fields are filled
    if (empty($firstName) || empty($lastName) || empty($email) || empty($position)) {
        $error_message = "Please complete all fields of the form before submitting";
    } else {
        // Sanitize and escape input data
        $firstName = mysqli_real_escape_string($conn, $firstName);
        $lastName = mysqli_real_escape_string($conn, $lastName);
        $email = mysqli_real_escape_string($conn, $email);
        $position = mysqli_real_escape_string($conn, $position);

        // Insert new staff member into the database
        $sql = "INSERT INTO staff (FirstName, LastName, Email, Position) VALUES ('$firstName', '$lastName', '$email', '$position')";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            echo "New staff member added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Display error message if any -->
<?php if (!empty($error_message)) : ?>
    <p class="error"><?php echo $error_message; ?></p>
<?php endif; ?>

<!-- New staff member form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- Form fields for user input -->
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="position">Position:</label>
    <select name="position" required>
        <!-- Dropdown menu for selecting position -->
        <option value="Lecturer">Lecturer</option>
        <option value="Senior Lecturer">Senior Lecturer</option>
        <option value="Reader">Reader</option>
        <option value="Professor">Professor</option>
    </select>

    <!-- Submit button to trigger form submission -->
    <input type="submit" value="Add Staff Member">
</form>

</body>
</html>
