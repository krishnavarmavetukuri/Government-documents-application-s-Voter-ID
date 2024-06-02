<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Service Portal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 30px;
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #3498DB;
            color: white;
            padding: 15px 25px;
            font-size: 2.5rem;
            font-weight: bold;
            width: 100%;
            margin: 0;
            border-bottom: 5px solid #2c88d9;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .header img {
            height: 50px;
        }
        .header-title {
            display: flex;
            align-items: center;
        }
        .header-title h1 {
            margin-left: 10px;
            font-size: 24px;
            font-weight: 500;
        }
        .header-user {
            display: flex;
            align-items: center;
        }
        .header-user img {
            height: 50px;
            margin-right: 10px;
        }
        .image-container {
            display: flex;
            align-items: center;
        }
        .side-text {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-header {
            background-color: #3498DB;
            color: white;
            padding: 15px 20px;
            border-radius: 5px 5px 0 0;
            font-size: 1.5rem;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1.2rem;
            line-height: 1.6;
        }
        .btn-primary {
            background-color: #3498DB;
            border-color: #3498DB;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2c88d9;
            border-color: #2c88d9;
        }
        .btn-primary i {
            margin-right: 5px;
        }
        .btn-social {
            margin-right: 10px;
            margin-bottom: 10px;
            font-size: 1.2rem;
            padding: 10px 15px;
            transition: transform 0.2s ease;
        }
        .btn-social:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="header">
            <div class="header-title">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuLifS3m4B3SBF0SzDMGS0aT1Ae_SwK80AMw&s" alt="Election Commission of India Logo">
                <h1>भारत निर्वाचन आयोग / Election Commission of India</h1>
            </div>
            <div class="header-user">
                <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="User Icon">
                <div>मतदाता सेवा पोर्टल / VOTERS' SERVICE PORTAL<br><?php
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

            // Query to retrieve user's first and last name based on MobileNumber, EmailID, or EPICNumber
            $query = "SELECT FirstName, LastName FROM Users WHERE MobileNumber = '9876543210' OR EmailID = 'priyaraniv@example.com' OR EPICNumber = 'SWD3748643'";
            $result = $conn->query($query);

            // If user found, display their name
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<div>' . $row["FirstName"] . ' ' . $row["LastName"] . '</div>';
            } else {
                echo '<div>User Not Found</div>';
            }

            // Close database connection
            $conn->close();
            ?></div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Forms
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Form 6</h5>
                        <p class="card-text">Application for inclusion of name in electoral roll.</p>
                        
						<a href="form 6.php" class="btn btn-primary"><i class="fas fa-file-alt"></i> Fill Form 6</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Services
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Track Application Status</h5>
                        <p class="card-text">Check the status of your application.</p>
                        <a href="application with tracking.html" class="btn btn-primary"><i class="fas fa-tasks"></i> Track Status</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Mobile Apps
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Voter Helpline App</h5>
                        <p class="card-text">Download the Voter Helpline App for all voter services.</p>
                        <a href="#" class="btn btn-primary"><i class="fab fa-google-play"></i> Download</a>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Contact Us
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Contact Number</h5>
                        <p class="card-text">1950 (Toll-free Number)</p>
                        <h5 class="card-title">Postal Address</h5>
                        <p class="card-text">Election Commission Of India, Nirvachan Sadan, Ashoka Road, New Delhi 110001</p>
                        <h5 class="card-title">Email</h5>
                        <p class="card-text">complaints@eci.gov.in</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Find Us On
            </div>
            <div class="card-body">
                <a href="#" id="facebookLink" class="btn btn-primary btn-social">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a href="#" id="twitterLink" class="btn btn-primary btn-social">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>