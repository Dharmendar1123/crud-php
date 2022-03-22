<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Delete</title>
</head>

<body>
    <?php

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "userdata";

    $email =  $userAddedSuccess = "";
    $emailError  = "";
    $flag = true;

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST['email'];

        if (empty($email)) {
            $emailError = "Email Should not be null empty";
            $flag = false;
        }

        if ($flag == true) {

            // $query = "SELECT TOP 1 users.id FROM users WHERE users.id = ?";

            // if ($connection->query($query) === TRUE) {

            $sql = "DELETE FROM users WHERE email = '$email'";

            if ($connection->query($sql) === FALSE) {
                echo "Error deleting record: " . $connection->error;
            }
            $userAddedSuccess = "Record Deleted successfully";
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

            <input class=" inputField" type="email" id="email" name="email" placeholder="Email"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>

</body>

</html>