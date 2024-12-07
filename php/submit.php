<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

$fname_id = $_POST["fname"];
$gender_id = $_POST["gender"];
$mnumber_id = $_POST["number"];
$birthdate_id = $_POST["birth"];
$email_id = $_POST["email"];
$address_id = $_POST["address"];
$username_id = $_POST["username"];
$passwd_id = $_POST["c_password1"];

$acc_lv_id = "Minor";

$passwd_hash = password_hash($passwd_id, PASSWORD_DEFAULT);

$checkquery = $conn->prepare("SELECT COUNT(*) FROM user_accounts WHERE username = ? OR email = ?");
$checkquery->bind_param("ss", $username_id, $email_id);
$checkquery->execute();
$checkquery->bind_result($count);
$checkquery->fetch();

if ($count > 0) {
    $response = [
        'success' => false,
        'message' => ' Username or email already exists. Please choose another.'
    ];
    echo json_encode($response);
    exit();
} else {

$stmt = $conn->prepare("INSERT INTO user_accounts (fname, gender, mnumber, birthdate, email, address, username, passwd_hash, acc_lv)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssss", $fname_id, $gender_id, $mnumber_id, $birthdate_id, $email_id, $address_id, $username_id, $passwd_hash, $acc_lv_id);


$stmt->execute();

}

$stmt->close();

$conn->close();


} else {
    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

    
    
}





?>