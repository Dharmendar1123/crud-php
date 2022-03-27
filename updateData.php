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
    include "encrypt.php";
    include "sqlConnection.php";

    // $dbServerName = "localhost";
    // $dbUserName = "root";
    // $dbPassword = "";
    // $dbName = "userdata";

    $firstName = $lastName = $email =  $userAddedSuccess = $userId = $password =  "";
    $firstNameError = $lastNameError = $emailError  = $noUserError = $passwordError = "";
    $flag = true;

    // $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    // if ($connection->connect_error) {
    //     die("Connection failed: " . $connection->connect_error);
    // }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $userId = decrypt($_GET['u_id']);
        $getUserQuery = "SELECT * FROM users WHERE id='$userId'";
        $output = $connection->query($getUserQuery);
        if ($output->num_rows > 0) {
            $data = $output->fetch_assoc();
            $firstName = $data['firstname'];
            $lastName = $data['lastname'];
            $email = $data['email'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $userId = $_POST['id'];
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

            $query = "SELECT * FROM users WHERE id = '$userId'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {

                $sql = "UPDATE users SET firstname='$firstName', lastname='$lastName', email='$email', password='$password'  WHERE id='$userId'";

                if ($connection->query($sql) === FALSE) {
                    echo "Error updating record: " . $connection->error;
                }
                $userAddedSuccess = "Record updated successfully";
                header('location:readData.php');
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

            <input class=" inputField" type="hidden" id="id" name="id" placeholder="ID" value="<?php echo $userId ?>"><br>

            <input class=" inputField" type="email" id="email" name="email" placeholder="Email" value="<?php echo $email ?>"><br>
            <span class="errorMsg"><?php echo $emailError; ?></span><br>

            <input class="inputField" type="text" id="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstName ?>"><br>
            <span class="errorMsg"><?php echo $firstNameError; ?></span><br>

            <input class="inputField" type="text" id="lastName" name="lastName" placeholder="Last Name" value="<?php echo $lastName ?>"><br>
            <span class="errorMsg"><?php echo $lastNameError; ?></span><br>

            <input class="inputField" type="password" name="password" placeholder="Password"><br>
            <span class="errorMsg"><?php echo $lastNameError; ?></span><br>

            <button class="submitBtn" type="submit" name="submit" value="Submit" onclick="alert('Record Updated Successfully');">Submit</button><br>
            <span class="successMsg"><?php echo $userAddedSuccess; ?></span>
            <span class="errorMsg"><?php echo $noUserError; ?></span>

            <a href="./readData.php" class="viewDataBtn">View Data</a>

        </form>
    </div>

</body>

</html>