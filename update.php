<?php
$conn = new mysqli("localhost", "root", "", "medication_system");

$old_name = $_POST['old_name'];
$name = $_POST['name'];
$medicine = $_POST['medicine'];
$dosage = $_POST['dosage'];
$time = $_POST['time'];

// Update user
$conn->query("UPDATE user SET name='$name' WHERE name='$old_name'");

// Get user_id
$result = $conn->query("SELECT user_id FROM user WHERE name='$name'");
$user = $result->fetch_assoc();
$user_id = $user['user_id'];

// Update medicine
$conn->query("UPDATE medicine SET medicine_name='$medicine', dosage='$dosage' WHERE user_id='$user_id'");

// Get medicine_id
$result2 = $conn->query("SELECT medicine_id FROM medicine WHERE user_id='$user_id'");
$med = $result2->fetch_assoc();
$medicine_id = $med['medicine_id'];

// Update schedule
$conn->query("UPDATE schedule SET time='$time' WHERE medicine_id='$medicine_id'");

header("Location: view.php");
exit();
?>
