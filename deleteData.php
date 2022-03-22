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
    include "encrypt.php";

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "userdata";

    $email =  $userAddedSuccess = "";
    $emailError  = $noUserError = "";
    $flag = true;

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //     $userId = $_GET['u_id'];
    //     $getUserQuery = "DELETE FROM users WHERE id = '$userId'";
    //     if ($connection->query($getUserQuery) === FALSE) {
    //         echo "Error deleting record: " . $connection->error;
    //     }
    // }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        // $email = $_POST['email'];
        $userId = decrypt($_GET['u_id']);

        // if (empty($userId)) {
        //     $emailError = "Email Should not be null empty";
        //     $flag = false;
        // }

        // if ($flag == true) {

        $query = "SELECT * FROM users WHERE id = '$userId'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {

            $sql = "DELETE FROM users WHERE id = '$userId'";

            if ($connection->query($sql) === FALSE) {
                echo "Error deleting record: " . $connection->error;
            }
            $userAddedSuccess = "Record Deleted successfully";
        } else {
            $noUserError =  "User Does Not Exist";
        }
        $connection->close();
        // }
    }
    header('location:readData.php');

    ?>
    <div class="createDataCard">
        <h1>Welcome</h1>
        <h3>Enter Values to Delete</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input class=" inputField" type="email" id="email" name="email" placeholder="Email"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>
            <span class="errorMsg"><?php echo $noUserError; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>

</body>

</html>