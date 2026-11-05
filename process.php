```php
<?php

require 'database.php';

$errors = [];

// Collect form information
$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$matric_no = strtoupper(trim($_POST['matric_no'] ?? ''));
$dob = $_POST['dob'] ?? '';
$department = $_POST['department'] ?? '';
$level = $_POST['level'] ?? '';
$gender = $_POST['gender'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Check required fields
if ($full_name == '') {
    $errors[] = "Full name is required.";
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address.";
}

// Validate Cameroon phone number
if (!preg_match('/^(?:\+?237)?6\d{8}$/', $phone)) {
    $errors[] = "Invalid phone number.";
}

// Validate matriculation number
if (!preg_match('/^[A-Z]{2}\d{7}$/', $matric_no)) {
    $errors[] = "Matric number must follow format SE2026001.";
}

// Validate date of birth
$date = DateTime::createFromFormat('Y-m-d', $dob);

if (!$date || $date->format('Y-m-d') !== $dob) {
    $errors[] = "Invalid date of birth.";
} elseif ($date > new DateTime('today')) {
    $errors[] = "Date of birth cannot be in the future.";
}

// Validate department
$departments = [
    "Software Engineering",
    "Computer Engineering",
    "Data Science"
];

if (!in_array($department, $departments, true)) {
    $errors[] = "Please select a valid department.";
}

// Validate level
$levels = ["HND 1", "HND 2", "Bachelor 1", "Bachelor 2"];

if (!in_array($level, $levels, true)) {
    $errors[] = "Please select a valid level.";
}

// Validate gender
$genders = ["Female", "Male", "Prefer not to say"];

if (!in_array($gender, $genders, true)) {
    $errors[] = "Please select a gender.";
}

// Validate password
if (strlen($password) < 8) {
    $errors[] = "Password must contain at least 8 characters.";
}

// Confirm password
if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}

// Validate accuracy checkbox
if (!isset($_POST['accuracy'])) {
    $errors[] = "Please confirm the accuracy of your information.";
}

// Display errors
if (!empty($errors)) {

    foreach ($errors as $error) {
        echo "<p style='color:red;'>"
             . htmlspecialchars($error) .
             "</p>";
    }

    echo "<a href='index.php'>Go back</a>";
    exit;
}

// Continue to database insertion only if validation succeeds.
?>
```


```php
// Hash the password
$password_hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);

try {

    $sql = "INSERT INTO students
    (full_name, email, phone, matric_no,
    date_of_birth, department, level, gender, password_hash)

    VALUES
    (:full_name, :email, :phone, :matric_no,
    :dob, :department, :level, :gender, :password_hash)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([

        ':full_name' => $full_name,
        ':email' => $email,
        ':phone' => $phone,
        ':matric_no' => $matric_no,
        ':dob' => $dob,
        ':department' => $department,
        ':level' => $level,
        ':gender' => $gender,
        ':password_hash' => $password_hash

    ]);

    echo "<h2>Registration Successful!</h2>";
    echo "<p>Your registration has been saved.</p>";

} catch (PDOException $e) {

    if ($e->getCode() == '23000') {

        echo "Email or matriculation number already exists.";

    } else {

        echo "Unable to save registration. Please try again later.";

    }

}
```
