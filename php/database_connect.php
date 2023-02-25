<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life_stream_ai";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        f_name VARCHAR(30) NOT NULL,
        l_name VARCHAR(30) NOT NULL,
        username VARCHAR(30) NOT NULL,
        ph_no VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        psw_hash VARCHAR(255) NOT NULL,
        user_state INT(1) NOT NULL,
        dashboard_type INT(1) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
    $sql = "CREATE TABLE IF NOT EXISTS donors_list (
        s_no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        age VARCHAR(30) NOT NULL,
        blood_group VARCHAR(30) NOT NULL,
        ph_no VARCHAR(30) NOT NULL,
        gender VARCHAR(30) NOT NULL,
        last_donation_date VARCHAR(50) NOT NULL,
        times_donated INT(3) NOT NULL,
        probable_donor INT(1) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Error creating database: " . $conn->error;
}
$conn->close();
function openCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "life_stream_ai";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}
function closeCon($conn)
{
    $conn->close();
}