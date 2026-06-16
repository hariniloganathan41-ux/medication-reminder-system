<?php
$conn = new mysqli("localhost", "root", "", "medication_system");

$name = $_GET['id'];

// Get user_id
$result = $conn->query("SELECT user_id FROM user WHERE name='$name'");
$row = $result->fetch_assoc();
$user_id = $row['user_id'];

// Get medicine_id
$result2 = $conn->query("SELECT medicine_id FROM medicine WHERE user_id='$user_id'");
$row2 = $result2->fetch_assoc();
$medicine_id = $row2['medicine_id'];

// Delete from schedule first
$conn->query("DELETE FROM schedule WHERE medicine_id='$medicine_id'");

// Delete from medicine
$conn->query("DELETE FROM medicine WHERE user_id='$user_id'");

// Delete from user
$conn->query("DELETE FROM user WHERE user_id='$user_id'");

echo "<script>
alert('Deleted successfully!');
window.location.href='view.php';
</script>";
?>