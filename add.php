<?php
$conn = new mysqli("localhost", "root", "", "medication_system");

$name = $_POST['name'];
$medicine = $_POST['medicine'];
$dosage = $_POST['dosage'];
$time = $_POST['time'];

$conn->query("INSERT INTO user (name) VALUES ('$name')");
$user_id = $conn->insert_id;

$conn->query("INSERT INTO medicine (user_id, medicine_name, dosage)
VALUES ('$user_id', '$medicine', '$dosage')");
$medicine_id = $conn->insert_id;

$conn->query("INSERT INTO schedule (medicine_id, time)
VALUES ('$medicine_id', '$time')");

// 🔥 THIS PART FIXES YOUR PROBLEM
echo "<script>
alert('Data Saved Successfully!');
window.location.href='index.html';
</script>";
exit();
?>