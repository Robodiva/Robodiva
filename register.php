
<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // Assuming no password is set
$dbname = "rhapsody";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$Firstname = $conn->real_escape_string($_POST['first_name']);
$Email = $conn->real_escape_string($_POST['email']);
$Phonenumber = $conn->real_escape_string($_POST['tel']);
$Password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Insert data into the table using prepared statements
$sql = "INSERT INTO register (first_name, email, phone_number, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $Firstname, $Email, $Phonenumber, $Password);

if ($stmt->execute()) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>