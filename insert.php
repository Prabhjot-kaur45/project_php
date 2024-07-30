<?php
include 'config.php';

$name = $_POST['name'];
$age = $_POST['age'];
$grade = $_POST['grade'];

$sql = "INSERT INTO students (name, age, grade) VALUES ('$name', '$age', '$grade')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: view.php');
?>