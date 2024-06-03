<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $sql = "INSERT INTO user (first_name, last_name, phone_number, email, password, address)
            VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$password', '$address')";

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
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        
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
        input[type="password"],
        textarea {
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
        <h2>User Registration</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <textarea name="address" placeholder="Address" required></textarea>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
