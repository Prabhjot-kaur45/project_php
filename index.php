<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CRUD Application</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="add.php">Add Student</a></li>
                <li><a href="view.php">View Students</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="register.php">Register</a></li>';
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </nav>
        <h1>Welcome to Student Record Management</h1>
    </header>
    
    <?php
    if (isset($_GET['msg1']) && $_GET['msg1'] === "insert") {
        echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                Your Registration was added successfully
              </div>";
    }
    if (isset($_GET['msg2']) && $_GET['msg2'] === "update") {
        echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                Your Registration was updated successfully
              </div>";
    }
    if (isset($_GET['msg3']) && $_GET['msg3'] === "delete") {
        echo "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                Record deleted successfully
              </div>";
    }
    ?>

    <main>
        <form action="insert.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" required>
            <button type="submit">Add Student</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Student Record Management</p>
    </footer>
</body>
</html>
