<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$database = "votersdb"; // Your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve states
$sql = "SELECT StateCode, StateName FROM States";
$result = $conn->query($sql);

// Populate dropdown options
$options = '<option value="">Select State</option>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row["StateCode"] . "'>" . $row["StateName"] . "</option>";
    }
} else {
    $options .= "<option value=''>No states found</option>";
}

// Close connection
$conn->close();

// Return dropdown options
echo $options;
?>
