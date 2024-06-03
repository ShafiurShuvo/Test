<?php
session_start();

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql1 = "SELECT * FROM user WHERE email='$email' and `password`='$password'";
    $result1 = $conn->query($sql1);


    $sql2 = "SELECT * FROM hospital WHERE email='$email' and `password`='$password'";
    $result2 = $conn->query($sql2);


    $sql3 = "SELECT * FROM `admin` WHERE Admin_Email='$email'and `password`='$password'";
    $result3 = $conn->query($sql3);


    $sqlBlocked = "SELECT * FROM user WHERE email='$email' and `password`='$password' and blocked='yes'";
    $resultBlocked = $conn->query($sqlBlocked);

    if ($resultBlocked->num_rows > 0) {
            echo "Your account has been blocked. Please contact admin.";
        }
    elseif ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['blocked'] = $row['blocked'];

        header("Location: user_home.php");
        exit();
    }

    elseif ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();

        $_SESSION['hospital_id'] = $row['hospital_id'];
        $_SESSION['hospital_name'] = $row['hospital_name'];
        $_SESSION['email'] = $row['email'];

        header("Location: hospital_home.php");
        exit();
    }

    elseif ($result3->num_rows > 0) {
        $row = $result3->fetch_assoc();

        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['Admin_Email'] = $row['Admin_Email'];

        header("Location: admin_home.php");
        exit();
    }   
     else {
        echo "Invalid email or password";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <i class='bx bx-user'></i>
            <input type="email" name="email" placeholder="Email" required>
            <i class='bx bx-lock' ></i>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="first_view.html">SignUp</a></p>
    </div>
</body>
</html>