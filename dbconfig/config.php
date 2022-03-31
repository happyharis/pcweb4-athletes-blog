<?php
$db_host = 'localhost';
$db_user = 'root';

// mac users need set this to 'root'
$db_password = 'root';

$db_db = 'athletes';

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

$con = $mysqli; // we use $con in our code
