<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Create</title>
</head>

<body>
    <?php
    include "encrypt.php";

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "userdata";

    $firstName = $lastName = $email = $password = $userAddedSuccess = "";
    $firstNameError = $lastNameError = $emailError = $passwordError = "";
    $flag = true;

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = passwordEncode($_POST['password']);

        if (empty($firstName)) {
            $firstNameError = "First Name should not be null empty";
            $flag = false;
        }
        if (empty($lastName)) {
            $lastNameError = "Last Name should not be null empty";
            $flag = false;
        }
        if (empty($email)) {
            $emailError = "Email Should not be null empty";
            $flag = false;
        }
        if (empty($password)) {
            $passwordError = "Password should not be null empty";
            $flag = false;
        }
        if ($flag == true) {

            $sql = "INSERT INTO users (firstname, lastname, email, password)
                VALUES ('$firstName', '$lastName', '$email', '$password')";

            if ($connection->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
            $userAddedSuccess = "User Added Successfully";
            $connection->close();

            header('location: readData.php');
        }
    }

    ?>
    <div class="createDataCard">
        <h1>Welcome</h1>
        <h3>Let's Create your Account</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input class="inputField" type="text" id="firstName" name="firstName" placeholder="First Name"><br>
            <span class="errorMsg"><?php echo $firstNameError; ?></span><br>

            <input class="inputField" type="text" id="lastName" name="lastName" placeholder="Last Name"><br>
            <span class="errorMsg"><?php echo $lastNameError; ?></span><br>

            <input class=" inputField" type="email" id="email" name="email" placeholder="Email"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <input class=" inputField" type="password" id="password" name="password" placeholder="Password"><br>
            <span class="errorMsg"><?php echo $passwordError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit" onclick="alert('User Added Successfully');">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>
</body>

</html>