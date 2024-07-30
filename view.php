<?php
session_start();
include 'config.php';

// Check if user is logged in
$is_logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View Students</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="add.php">Add Student</a></li>
                <li><a href="view.php">View Students</a></li>
                <?php if ($is_logged_in): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <h1>Student List</h1>
    </header>
    <main>
        <?php
        $result = $conn->query("SELECT * FROM students");
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Age</th><th>Grade</th><th>Actions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['grade']}</td>
                        <td>
                            <a href='update.php?id={$row['id']}'>Update</a> |
                            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No records found.";
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Student Record Management</p>
    </footer>
</body>
</html>
