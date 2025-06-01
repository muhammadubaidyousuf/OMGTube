<?php
require_once '../config/database.php';

// Check if database exists
$check_db = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'video_portal'");
if (!$check_db || $check_db->num_rows === 0) {
    die("Database 'video_portal' does not exist!");
}

// Create admin user if not exists, or update if exists
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$email = 'admin@example.com';
$username = 'admin';
$full_name = 'Administrator';
$role = 'admin';

// First try to find if user exists
$query = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing user
    $query = "UPDATE users SET password = ?, username = ?, full_name = ?, role = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $hashed_password, $username, $full_name, $role, $email);
    if ($stmt->execute()) {
        echo "Admin user updated successfully!\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n";
    } else {
        echo "Error updating admin user: " . $conn->error . "\n";
    }
} else {
    // Create new user
    $query = "INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $username, $email, $hashed_password, $full_name, $role);
    if ($stmt->execute()) {
        echo "Admin user created successfully!\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n";
    } else {
        echo "Error creating admin user: " . $conn->error . "\n";
    }
}

// Verify the user exists and password is correct
$query = "SELECT id, password FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "\nVerification successful - login should work now!\n";
    } else {
        echo "\nWarning: Password verification failed!\n";
    }
} else {
    echo "\nWarning: Could not verify user creation/update!\n";
}
?>
