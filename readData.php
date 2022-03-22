<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>User Data</title>
</head>

<body>
    <h1 style="text-align: center;">User Data</h1>
    <?php
    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "userdata";

    $connection = new mysqli($dbServerName, $dbUserName, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM users";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='readDataCard'>";
        echo "<table><tr><td>ID</td><th>First Name</th><th>Last Name</th><th>Email Id</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "0 Result";
    }

    $connection->close();

    ?>

    <a href="./createData.php" class="viewDataBtn">Add User</a>
    <a href="./updateData.php" class="editBtn">Update User</a>
    <a href="./deleteData.php" class="deleteBtn">Delete User</a>

</body>

</html>