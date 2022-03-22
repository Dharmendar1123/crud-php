<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Update</title>
</head>

<body>
    <?php

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "userdata";

    $firstName = $lastName = $email =  $userAddedSuccess = $userId = "";
    $firstNameError = $lastNameError = $emailError  = $userIdError = "";
    $flag = true;

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $userId = $_POST['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

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
        if (empty($userId)) {
            $userIdError = "UserId should not be null empty";
            $flag = false;
        }
        if ($flag == true) {

            // $query = "SELECT TOP 1 users.id FROM users WHERE users.id = ?";

            // if ($connection->query($query) === TRUE) {

            $sql = "UPDATE users SET firstname='$firstName', lastname='$lastName' WHERE id='$userId'";

            if ($connection->query($sql) === FALSE) {
                echo "Error updating record: " . $connection->error;
            }
            $userAddedSuccess = "Record updated successfully";
            // } else {
            //     echo "No Such Record Found";
            // }
            $connection->close();
        }
    }

    ?>
    <div class="createDataCard">
        <h1>Welcome</h1>
        <h3>Enter Values to Update</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input class="inputField" type="text" id="userId" name="userId" placeholder="User Id"><br>
            <span class="errorMsg"><?php echo $userIdError; ?></span><br>

            <input class="inputField" type="text" id="firstName" name="firstName" placeholder="First Name"><br>
            <span class="errorMsg"><?php echo $firstNameError; ?></span><br>

            <input class="inputField" type="text" id="lastName" name="lastName" placeholder="Last Name"><br>
            <span class="errorMsg"><?php echo $lastNameError; ?></span><br>

            <input class=" inputField" type="email" id="email" name="email" placeholder="Email"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>

</body>

</html>