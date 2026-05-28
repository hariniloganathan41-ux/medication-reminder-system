<?php
$conn = new mysqli("localhost", "root", "", "medication_system");

$id = $_GET['id'];

$result = $conn->query("
SELECT user.name, medicine.medicine_name, medicine.dosage, schedule.time
FROM user
JOIN medicine ON user.user_id = medicine.user_id
JOIN schedule ON medicine.medicine_id = schedule.medicine_id
WHERE user.name='$id'
");

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Medication</title>

<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #36d1dc, #5b86e5);
    text-align: center;
}

.container {
    background: white;
    padding: 25px;
    margin: 60px auto;
    width: 320px;
    border-radius: 15px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.2);
}

h2 {
    color: #333;
}

input {
    width: 90%;
    padding: 10px;
    margin: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    background: #007bff;
    color: white;
    padding: 12px;
    border: none;
    width: 95%;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #0056b3;
}
</style>
</head>

<body>

<div class="container">
<h2>✏️ Edit Medication</h2>

<form action="update.php" method="POST">

<input type="hidden" name="old_name" value="<?php echo $row['name']; ?>">

<input type="text" name="name" value="<?php echo $row['name']; ?>" required>
<input type="text" name="medicine" value="<?php echo $row['medicine_name']; ?>" required>
<input type="text" name="dosage" value="<?php echo $row['dosage']; ?>" required>
<input type="time" name="time" value="<?php echo substr($row['time'],0,5); ?>" required>

<button type="submit">Update</button>

</form>
</div>

</body>
</html>
