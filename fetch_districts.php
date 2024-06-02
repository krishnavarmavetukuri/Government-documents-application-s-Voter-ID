<?php
// Check if state code is provided
if(isset($_GET['stateCode'])) {
    $stateCode = $_GET['stateCode'];

    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votersdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query to fetch districts based on state code
    $stmt = $conn->prepare("SELECT DistrictName FROM Districts WHERE StateCode = ?");
    $stmt->bind_param("s", $stateCode);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch districts into an array
    $districts = [];
    while ($row = $result->fetch_assoc()) {
        $districts[] = $row['DistrictName'];
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Return districts as JSON
    echo json_encode($districts);
} else {
    // State code not provided
    echo json_encode(array('error' => 'State code not provided'));
}
?>
