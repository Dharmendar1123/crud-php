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
    $firstNameError = $lastNameError = $emailError  = $noUserError = "";
    $flag = true;

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        if ($flag == true) {

            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {

                $sql = "UPDATE users SET firstname='$firstName', lastname='$lastName' WHERE email='$email'";

                if ($connection->query($sql) === FALSE) {
                    echo "Error updating record: " . $connection->error;
                }
                $userAddedSuccess = "Record updated successfully";
            } else {
                $noUserError =  "User Does Not Exist";
            }
            $connection->close();
        }
    }

    ?>
    <div class="createDataCard">
        <h1>Welcome</h1>
        <h3>Enter Values to Update</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input class=" inputField" type="email" id="email" name="email" placeholder="Email" value="<?php echo $email ?>"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <input class="inputField" type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName ?>"><br>
            <span class="errorMsg"><?php echo $firstNameError; ?></span><br>

            <input class="inputField" type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName ?>"><br>
            <span class="errorMsg"><?php echo $lastNameError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>
            <span class="errorMsg"><?php echo $noUserError; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>

</body>

</html>