<?php
require_once '../config/database.php';

// Test database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Database connection successful!\n\n";

// Show all tables
echo "Database Tables:\n";
$tables = $conn->query("SHOW TABLES");
if ($tables) {
    while ($table = $tables->fetch_array()) {
        echo "- " . $table[0] . "\n";
    }
} else {
    echo "No tables found\n";
}

echo "\n";

// Check if admin user exists
$query = "SELECT id, email, username, password FROM users WHERE email = 'admin@example.com'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "Admin user found:\n";
    echo "ID: " . $user['id'] . "\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Username: " . $user['username'] . "\n";
    echo "Password Hash Length: " . strlen($user['password']) . " characters\n";
    echo "Password Hash: " . $user['password'] . "\n";
} else {
    echo "Admin user not found in database\n";
    
    // Check if users table exists and has any records
    $query = "SELECT COUNT(*) as total FROM users";
    $result = $conn->query($query);
    if ($result) {
        $count = $result->fetch_assoc()['total'];
        echo "\nTotal users in database: " . $count . "\n";
    }
}

// Check if database was properly initialized
echo "\nChecking database initialization:\n";
$tables_to_check = ['users', 'categories', 'videos', 'tags', 'video_tags'];
foreach ($tables_to_check as $table) {
    $result = $conn->query("SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $count = $result->fetch_assoc()['count'];
        echo "$table table: $count records\n";
    } else {
        echo "$table table: Not found or error\n";
    }
}
?>
