<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $sql = "UPDATE students SET name=?, age=?, grade=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $name, $age, $grade, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: view.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Update Student</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="add.php">Add Student</a></li>
                <li><a href="view.php">View Students</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <h1>Update Student</h1>
    </header>
    <main>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($student['age']); ?>" required>
            <label for="grade">Grade:</label>
            <input type="text" id="grade" name="grade" value="<?php echo htmlspecialchars($student['grade']); ?>" required>
            <button type="submit">Update Student</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Student Record Management</p>
    </footer>
</body>
</html>
