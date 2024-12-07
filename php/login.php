<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

$username_id = $_POST["username"];
$passwd_id = $_POST["password"];

if ($username_id == "admin") {

    $identifyer = "1";

    $stmt3 = $conn->prepare("SELECT * FROM admin_account WHERE id = ?");
    $stmt3->bind_param("i", $identifyer);
    $stmt3->execute();
    $stmt3_result = $stmt3->get_result();

    if ($stmt3_result->num_rows > 0) {

        $admin_accounts = $stmt3_result->fetch_assoc();

        if ($passwd_id == $admin_accounts["password"]) {

            session_start();

            $_SESSION["username"] = $admin_accounts["username"];

            header("Location: http://localhost/e_commerce-main/admin.php");

            exit();

        } else {

            echo '<script>
                alert("Invalid Actions");
                window.location.href = "http://localhost/e_commerce-main/login.html";
            </script>';

        }

    }

} else {

$code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");

$stmt->bind_param("s", $username_id);

$stmt->execute();

$result = $stmt->get_result();

    if ($result->num_rows > 0) {
    
        $accounts = $result->fetch_assoc();
    
        if (password_verify($passwd_id, $accounts['passwd_hash'])) {
    
            $stmt2 = $conn->prepare("UPDATE user_accounts SET request_code = ? WHERE username = ?");
            $stmt2->bind_param("ss", $code, $username_id);
            $stmt2->execute();
    
            session_start();
            $_SESSION['username'] = $accounts["username"];
            sleep(2);
            header("Location: http://localhost/e_commerce-main/2FA.php");
            exit();
            
        } else {
    
            echo '<script>
                alert("Incorrect Password");
                window.location.href = "http://localhost/e_commerce-main/login.html";
            </script>';
            exit();
        }
    
    } else {

        echo '<script>
        alert("User Not Existed");
        window.location.href = "http://localhost/e_commerce-main/login.html";
        </script>';
        exit();

    }


$stmt->close();
$stmt2->close();

$conn->close();

}

} else {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';

}



?>