<?php
$conn = new mysqli("localhost", "root", "", "medication_system");

$result = $conn->query("
SELECT user.name, medicine.medicine_name, medicine.dosage, schedule.time
FROM user
JOIN medicine ON user.user_id = medicine.user_id
JOIN schedule ON medicine.medicine_id = schedule.medicine_id
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Medication Records</title>

<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #667eea, #764ba2);
    text-align: center;
}

h2 { color: white; }

table {
    margin: 30px auto;
    border-collapse: collapse;
    width: 85%;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

th {
    background: #007bff;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

tr:hover { background: #f1f1f1; }

a { text-decoration: none; font-weight: bold; }
a[href*="edit"] { color: blue; }
a[href*="delete"] { color: red; }

#popup {
    display:none;
    position:fixed;
    top:30%;
    left:35%;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<h2>💊 Medication Records</h2>

<table>
<tr>
<th>Name</th>
<th>Medicine</th>
<th>Dosage</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
while($row = $result->fetch_assoc()) {
echo "<tr>
<td class='med-name'>".$row['name']."</td>
<td class='med-medicine'>".$row['medicine_name']."</td>
<td class='med-dosage'>".$row['dosage']."</td>
<td class='med-time'>".$row['time']."</td>
<td class='status'>Pending</td>
<td>
<a href='edit.php?id=".$row['name']."'>Edit</a> |
<a href='delete.php?id=".$row['name']."'>Delete</a>
</td>
</tr>";
}
?>
</table>

<!-- Popup -->
<div id="popup">
    <p id="popupText"></p>
    <button onclick="stopAlarm()">OK</button>
</div>

<!-- Sound -->
<audio id="alarmSound" src="alarm.mp3"></audio>

<script>
let alarm = document.getElementById("alarmSound");
let triggeredTimes = [];

setInterval(function() {

    let now = new Date();

    let hours = now.getHours().toString().padStart(2,'0');
    let minutes = now.getMinutes().toString().padStart(2,'0');

    let currentTime = hours + ":" + minutes;

    let times = document.querySelectorAll(".med-time");
    let names = document.querySelectorAll(".med-name");
    let medicines = document.querySelectorAll(".med-medicine");
    let dosages = document.querySelectorAll(".med-dosage");
    let status = document.querySelectorAll(".status");

    times.forEach(function(t, index){

        let dbTime = t.innerText.substring(0,5);

        let dbParts = dbTime.split(":");
        let dbDate = new Date();
        dbDate.setHours(dbParts[0], dbParts[1], 0);

        let nowDate = new Date();

        let diff = (dbDate - nowDate) / 60000; // minutes

        // 🔴 TAKE NOW
        if(dbTime === currentTime && !triggeredTimes.includes(dbTime)){

            status[index].innerText = "Take Now!";
            status[index].style.color = "red";

            t.parentElement.style.background = "#ffeeba";

            document.getElementById("popup").style.display = "block";
            document.getElementById("popupText").innerText =
                "💊 " + names[index].innerText + ", take " +
                medicines[index].innerText + " (" +
                dosages[index].innerText + ")";

            alarm.loop = true;
            alarm.play();

            triggeredTimes.push(dbTime);
        }

        // 🟢 UPCOMING
        else if(diff > 0){

            if(diff >= 60){
                let hrs = Math.floor(diff/60);
                status[index].innerText = "In " + hrs + " hr";
            } else {
                status[index].innerText = "In " + Math.floor(diff) + " min";
            }

            status[index].style.color = "green";
        }

        // ⚠️ MISSED
        else if(diff < 0){
            status[index].innerText = "Missed";
            status[index].style.color = "orange";
        }

    });

}, 5000);

// ✅ Stop alarm + mark as Taken
function stopAlarm(){

    let status = document.querySelectorAll(".status");

    status.forEach(function(s){
        if(s.innerText === "Take Now!"){
            s.innerText = "Taken";
            s.style.color = "blue";
        }
    });

    alarm.pause();
    alarm.currentTime = 0;
    document.getElementById("popup").style.display = "none";
}
</script>

</body>
</html>