<?php
    // Retrieve data from the submitted form
    $Name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $ethnicity = $_POST['ethnicity'];

    // Create a new MySQLi connection
    $conn = new mysqli('localhost','root','','test');

    // Check if the connection is successful
	if($conn->connect_error){
		echo "$conn->connect_error"; // Output any connection error
		die("Connection Failed : ". $conn->connect_error); // Stop execution if connection fails
	} else {
        // Prepare a SQL statement to insert data into the 'registration' table
		$stmt = $conn->prepare("insert into registration(name, address, email, contact, gender, qualification, ethnicity) values(?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
		$stmt->bind_param("sssssss", $Name, $address, $email, $contact, $gender, $qualification, $ethnicity);

        // Execute the prepared statement
		$execval = $stmt->execute();

        // Output the result of the execution
		echo $execval;

        // Output a success message
		echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">';
   		echo '<h1 style="color: #333; font-family: Arial, sans-serif;">Customer Added Successfully!</h1>';

        // Output a link to go back to the home page
		echo "<a href=\"index.html\">Go Home</a></br>";
		echo "<a href=\"test.php\">Go to Customers</a>";
    	echo '</div>';

        // Close the prepared statement
		$stmt->close();

        // Close the database connection
		$conn->close();
	}
?>
