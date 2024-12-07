<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";
    
$conn = new mysqli($servername, $username, $password, $dbname);

$request_code_id = $_POST["code"];

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");



} else {
    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
}





?>
