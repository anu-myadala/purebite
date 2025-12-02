<?php
$USERNAME = $_POST['USERNAME'];
$PASSWORD = $_POST['PASSWORD'];

$file = fopen("password.txt", "r");
$userVerified = 0;

while(!feof($file) && !$userVerified) {
    $line = chop(fgets($file, 255));
    $field = explode(",", $line, 2);

    if($USERNAME == $field[0]) {
        $userVerified = 1;
        if(checkPassword($PASSWORD, $field) == true) {
            accessGranted($USERNAME);
        } else {
            wrongPassword();
        }
    }
}

fclose($file);

if(!$userVerified) {
    accessDenied();
}

// --- Helper functions ---

// Helper function to get user_id from username
// This ensures redirect.php can find user_id in session
// Defined BEFORE it's used to avoid any potential issues
function getUserID($username) {
    // Option 1: Simple hash-based ID (consistent for same username)
    return abs(crc32($username)) % 1000000; // Returns 0-999999
    
    // Option 2: If you have a user ID mapping, use that instead:
    // $userMap = ['admin' => 1, 'user2' => 2, ...];
    // return isset($userMap[$username]) ? $userMap[$username] : 0;
}

function checkPassword($userpassword, $filedata) {
    if(trim($userpassword) == trim($filedata[1])) return true;
    else return false;
}

function accessGranted($name) {
    session_start();
    $_SESSION['user'] = $name;
    // Set user_id for compatibility with combined website redirect.php
    // Generate a consistent numeric ID from username (or use a mapping)
    $_SESSION['user_id'] = getUserID($name);
    header("Location: users.php");
    exit;
}

function wrongPassword() {
    echo "<h2 style='color:red;text-align:center;'>Invalid password. Access denied.</h2>";
}

function accessDenied() {
    echo "<h2 style='color:red;text-align:center;'>User not found. Access denied.</h2>";
}
?>
