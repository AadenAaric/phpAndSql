<?php
// Check if the ID is received via POST
if(isset($_POST['ID'])) {
    // Retrieve data from the form
    $id = $_POST['ID'];
    $Name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $ethnicity = $_POST['ethnicity'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update record in the database using prepared statement
    $sql = "UPDATE registration SET name=?, address=?, email=?, contact=?, gender=?, qualification=?, ethnicity=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $Name, $address, $email, $contact, $gender, $qualification, $ethnicity, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
        // Redirect to the main page after successful update
        header("Location: test.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "ID parameter is missing";
}
?>