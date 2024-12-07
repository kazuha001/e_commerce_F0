<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e_commerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION["username"])) {

    echo '<div style="width:100%; display: flex; justify-content: center;"><h1>Invalid Request :(</h1></div>';
    sleep(2);
    header("Location: login.html");

    exit();
} else {

    $username = $_SESSION["username"];

    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $accounts = $result->fetch_assoc();

        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- CSS links -->
    <link rel="stylesheet" href="css/default.css">

    <link rel="stylesheet" href="css/user_pp.css">

</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header_left">
                <div class="user_information">
                    <div class="header_left_img"><img src="images/images.png" alt="images"></div><!--Overlay-->
                    <p>UID: ' . $accounts["id"] . ' || ACC LV: ' . $accounts["acc_lv"] . '</p>
                    <h1>' . $accounts["fname"] . '</h1>
                    <h4>' . $accounts["email"] . '</h4>
                    <h3>' . $accounts["address"] . '</h3>
                    <form action="update_account.php">
                        <button>Edit Personal Information</button>
                    </form>
                </div>
            </div>
            <div class="header_right">
                <div class="header_right_top">
                    <h2>Options</h2>
                    <div class="header_right_top_support">
                        <div class="header_right_top_left">
                            <div class="header_right_top_left_img">
                                <div></div><!-- Overlay -->
                            </div>
                        </div>
                        <div class="header_right_top_right">
                            <div class="header_right_top_right_img">
                                <div></div><!-- Overlay -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_right_bottom">
                    <h2>Shop</h2>
                    <div class="header_right_bottom_support">
                        <div class="header_right_bottom_left">
                            <div class="header_right_bottom_left_img">
                                <div></div><!-- Overlay -->
                            </div>
                            
                        </div>
                        <div class="header_right_bottom_right">
                            <h3>Information Guide</h3>
                            <p>Being a Seller or<br> Shop Owner 
                            you need <br>to Activate to<br><u>Major Account Level</u> <br>
                            you are need to Contact <br> the Admin for
                            Account Upgrade</p>
                        </div>
                    </div>
    
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>';

    }

    

}


?>



