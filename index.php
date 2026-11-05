<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>STUDENT REGISTRATION</h1>
    <p>Complete all required fields marked *</p>

    <form method="POST">

        <label>Full Name *</label>
        <input type="text" name="full_name" placeholder="e.g. Ada Nfor" required>

        <label>Email Address *</label>
        <input type="email" name="email" placeholder="student@example.com" required>

        <label>Phone Number *</label>
        <input type="tel" name="phone" placeholder="e.g. 6XXXXXXXX" required>

        <label>Matriculation Number *</label>
        <input type="text" name="matric_no" placeholder="e.g. SE2026001" required>

        <label>Date of Birth *</label>
        <input type="date" name="date_of_birth" required>

        <label>Department *</label>
        <select name="department" required>
            <option value="">Select department</option>
        </select>

        <label>Level *</label>
        <select name="level" required>
            <option value="">Select level</option>
        </select>

        <label>Gender *</label>
        <label><input type="radio" name="gender" value="Female" required> Female</label>
        <label><input type="radio" name="gender" value="Male"> Male</label>
        <label><input type="radio" name="gender" value="Prefer not to say"> Prefer not to say</label>

        <label>Password *</label>
        <input type="password" name="password" required>

        <label>Confirm Password *</label>
        <input type="password" name="confirm_password" required>

        <label>
            <input type="checkbox" name="accuracy" required>
            I confirm that the information provided is accurate.
        </label>

        <button type="submit">SUBMIT REGISTRATION</button>

    </form>

</div>

</body>
</html>


