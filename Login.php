<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votersdb";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    $registeredId = $_POST['registered-id'];
    $password = $_POST['password'];

    // Sanitize input
    $registeredId = $conn->real_escape_string($registeredId);
    $password = $conn->real_escape_string($password);

    // Hash the password
    $passwordHash = sha1($password);

    // Query to check if user exists
    $sql = "SELECT FirstName, LastName FROM Users WHERE (MobileNumber='$registeredId' OR EmailID='$registeredId' OR EPICNumber='$registeredId') AND PasswordHash='$passwordHash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found
        $row = $result->fetch_assoc();
        $_SESSION['firstName'] = $row['FirstName'];
        $_SESSION['lastName'] = $row['LastName'];
        
        // Redirect to home page
        header("Location: home_new.php");
        exit();
    } else {
        // User not found, redirect back to login page with error message
        header("Location: login.php?error=1");
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Commission of India Login</title>
    
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }
        .container {
            display: flex;
            width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .left {
            background-color: #253a81;
            color: white;
            padding: 40px;
            width: 40%;
            text-align: center;
        }
        .left img {
            width: 100px;
            margin-bottom: 20px;
        }
        .left h2 {
            margin: 0;
            font-size: 24px;
        }
        .right {
            background-color: white;
            padding: 40px;
            width: 60%;
        }
        .right h2 {
            margin-top: 0;
            font-size: 24px;
        }
        .right form {
            display: flex;
            flex-direction: column;
        }
        .right form label {
            margin: 10px 0 5px;
        }
        .right form input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .right form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .right form button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .right form .signup {
            text-align: center;
            margin-top: 20px;
        }
        .right form .signup a {
            color: #007bff;
            text-decoration: none;
        }
        .right form .signup a:hover {
            text-decoration: underline;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <!-- Left side content here -->
        </div>
        <div class="right">
            <h2>Login</h2>
            <?php
            // Check if error parameter is present in URL
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red;">Invalid credentials. Please try again.</p>';
            }
            ?>
            <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="registered-id">Registered Mobile No./Email ID/EPIC No.<span class="required">*</span></label>
                <input type="text" id="registered-id" name="registered-id" required>
                <label for="password">Password<span class="required">*</span></label>
                <input type="password" id="password" name="password" required>
                <button type="submit" id="submit-button">Continue</button>
                <div class="signup">
                    <p>Do not have an account? <a href="#" id="signupLink">Sign-Up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const registeredIdInput = document.getElementById('registered-id');
            const passwordInput = document.getElementById('password');
            const submitButton = document.getElementById('submit-button');

            function validateForm() {
                if (registeredIdInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            registeredIdInput.addEventListener('input', validateForm);
            passwordInput.addEventListener('input', validateForm);

            const signupLink = document.getElementById('signupLink');
            signupLink.addEventListener('click', function(event) {
                event.preventDefault();
                window.location.href = 'Sign-Up.html';
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const form = urlParams.get('form');

            if (form === '6') {
                // Pre-fill the form for Form 6
                // Example: Set values in input fields based on the query parameter
            }

            // Handle form submission and navigation
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const nextPage = 'home_new.php'; // Change this to the next page URL
                window.location.href = nextPage;
            });
        });
    </script>
</body>
</html>
