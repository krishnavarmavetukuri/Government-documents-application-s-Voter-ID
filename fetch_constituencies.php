<?php
// Check if district name is provided
if(isset($_GET['districtName'])) {
    $districtName = $_GET['districtName'];

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

    // Prepare and execute query to fetch constituencies based on district name
    $stmt = $conn->prepare("SELECT ConstituencyName FROM Constituencies WHERE DistrictCode = (SELECT DistrictCode FROM Districts WHERE DistrictName = ?)");
    $stmt->bind_param("s", $districtName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch constituencies into an array
    $constituencies = [];
    while ($row = $result->fetch_assoc()) {
        $constituencies[] = $row['ConstituencyName'];
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();

    // Return constituencies as JSON
    echo json_encode($constituencies);
} else {
    // District name not provided
    echo json_encode(array('error' => 'District name not provided'));
}
?>
