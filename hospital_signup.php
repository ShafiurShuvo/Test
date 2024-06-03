<?php
include "connection.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $hospital_name = $_POST['hospital_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert hospital data into the database
    $sql = "INSERT INTO hospital (hospital_name, email, password)
            VALUES ('$hospital_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hospital Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
       /* Add this CSS to your existing styles.css file or use it as a separate CSS file */
            
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2>Hospital Registration</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="hospital_name" placeholder="Hospital Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>