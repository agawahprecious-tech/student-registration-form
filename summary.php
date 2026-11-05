<?php

require 'database.php';

$search = $_GET['matric_no'] ?? '';

$sql = "SELECT student_id, full_name, email,
        matric_no, department, level, gender
        FROM students
        WHERE matric_no LIKE :matric_no";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':matric_no' => '%' . $search . '%'
]);

$students = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Summary</title>
</head>

<body>

<h2>Student Registration Summary</h2>

<form method="GET">

    <input type="text"
    name="matric_no"
    placeholder="Search matriculation number">

    <button type="submit">Search</button>

</form>

<table border="1" cellpadding="10">

<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Matric Number</th>
    <th>Department</th>
    <th>Level</th>
    <th>Gender</th>
</tr>

<?php foreach ($students as $student): ?>

<tr>

<td><?= htmlspecialchars($student['full_name']) ?></td>

<td><?= htmlspecialchars($student['email']) ?></td>

<td><?= htmlspecialchars($student['matric_no']) ?></td>

<td><?= htmlspecialchars($student['department']) ?></td>

<td><?= htmlspecialchars($student['level']) ?></td>

<td><?= htmlspecialchars($student['gender']) ?></td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>