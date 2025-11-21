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
function checkPassword($userpassword, $filedata) {
    if(trim($userpassword) == trim($filedata[1])) return true;
    else return false;
}

function accessGranted($name) {
    session_start();
    $_SESSION['user'] = $name;
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
