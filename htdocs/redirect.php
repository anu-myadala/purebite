<?php
/**
 * redirect.php - Fixed version to handle NULL user_id
 * 
 * This file handles redirects and tracks them in the database.
 * Fixed to handle cases where user_id might be NULL (when user is not logged in).
 */

session_start();

// Get user_id from session if available
// Check for different possible session variable names
$user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_SESSION['user'])) {
    // If session stores username, you might need to look up the user_id
    // For now, we'll handle it as null and use a guest ID
    $user_id = null;
}

// Get redirect information
$redirect_url = isset($_GET['url']) ? $_GET['url'] : (isset($_POST['url']) ? $_POST['url'] : '/');
$redirect_type = isset($_GET['type']) ? $_GET['type'] : (isset($_POST['type']) ? $_POST['type'] : 'default');

// Database connection - adjust these values based on your Render database configuration
// These should be set as environment variables in Render
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'your_db_user';
$password = getenv('DB_PASSWORD') ?: 'your_db_password';
$database = getenv('DB_NAME') ?: 'your_db_name';

try {
    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        // If database connection fails, just redirect without logging
        header("Location: " . htmlspecialchars($redirect_url));
        exit;
    }
    
    // SOLUTION: Handle NULL user_id properly
    // Option 1: Use a default guest user ID (RECOMMENDED if your DB doesn't allow NULL)
    // Change 0 to whatever ID represents guest/anonymous users in your database
    $guest_user_id = 0; // or -1, or whatever your guest user ID is
    
    if ($user_id === null) {
        $user_id = $guest_user_id;
    }
    
    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO redirects (user_id, redirect_url, redirect_type, created_at) VALUES (?, ?, ?, NOW())");
    
    if ($stmt) {
        $stmt->bind_param("iss", $user_id, $redirect_url, $redirect_type);
        $stmt->execute();
        $stmt->close();
    }
    
    $conn->close();
    
} catch (mysqli_sql_exception $e) {
    // If there's an error, log it but don't break the redirect
    error_log("Redirect tracking error: " . $e->getMessage());
    
    // If the error is about user_id being null, and we haven't set a guest ID,
    // try to skip the database insert entirely
    if (strpos($e->getMessage(), "user_id") !== false && strpos($e->getMessage(), "cannot be null") !== false) {
        error_log("Warning: user_id is null and database doesn't allow it. Consider using a guest user ID.");
    }
} catch (Exception $e) {
    // Handle any other errors
    error_log("Unexpected error in redirect.php: " . $e->getMessage());
}

// Always redirect, even if database logging failed
header("Location: " . htmlspecialchars($redirect_url));
exit;
?>

