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

        echo '
            <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>

    <!-- CSS links -->
    
    <!-- Default css -->
    <link rel="stylesheet" href="css/default.css">
    
    <link rel="stylesheet" href="css/log_in_sign_up.css">

    <link rel="stylesheet" href="css/update.css">

</head>
<body>
    
    <div class="container">
        <div class="sign_in">
            <div class="sign_in_form" id="animation2"><!-- Sign Up -->

                <div class="overlay_images"><img src="Icons/open-enrollment.gif" alt="gif"></div>
                <h1>Update Information</h1>
                <div class="sign_in_form_fill_profile_pic">
                    <label for="image"> Upload Profile Picture:</label>
                    <div class="sign_in_form_fill_profile_pic_support">
                        <img src="" alt="Profile Pic" id="">
                        <button>Upload Images</button>
                    </div>
                    
                </div>
                <form action="" method="post">
                    
                    
                    <div class="sign_in_form_fill">
                        <label for="fname"> Fullname:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_5"></div><!-- Overlay -->
                            <input type="text" id="fname" name="fname" placeholder="Enter your Fullname" value="' . $accounts["fname"] . '" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="gender"> Gender:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_16"></div><!-- Overlay -->
                            <select name="gender" id="gender" required>
                                <option value="' . $accounts["gender"] . '"> Current Gender ' . $accounts["gender"] . '</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="N/A">Not to Tell</option>
                            </select>
                        </div>
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="number"> Mobile Number:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_6"></div><!-- Overlay -->
                            <input type="tel" id="number" name="number" placeholder="Enter your Mobile Number" value="' . $accounts["mnumber"] . '" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="birth"> Birthday:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_13"></div><!-- Overlay -->
                            <input type="date" id="birth" name="birth" placeholder="Enter your Mobile Number" value="' . $accounts["birthdate"] . '" required>
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="email"> Email:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_7"></div><!-- Overlay -->
                            <input type="email" id="email" name="email" placeholder="Enter your Email @" required autocomplete="email" value="' . $accounts["email"] . '">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="address"> address:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_17"></div><!-- Overlay -->
                            <input type="address" id="address" name="address" placeholder="Enter your Address" required autocomplete="street-address" value="' . $accounts["address"] . '">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="username1"> Username:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_8"></div><!-- Overlay -->
                            <input type="text" id="username1" name="username1" placeholder="Enter your Username" required value="' . $accounts["username"] . '">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="password1"> Enter Current  Password:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_9"></div><!-- Overlay -->
                            <input type="password" id="password1" name="password1" placeholder="Enter your Password">
                            <img src="Icons/invisible.png" alt="images" onclick="showpasswd1()" id="showpass1">
                        </div>
                        
                    </div>

                    <div class="sign_in_form_fill">
                        <label for="password1"> Enter New Password:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_9"></div><!-- Overlay -->
                            <input type="password" id="password1" name="password1" placeholder="Enter your Password">
                            <img src="Icons/invisible.png" alt="images" onclick="showpasswd1()" id="showpass1">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="c_password1"> Confirm New Password:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_10"></div><!-- Overlay -->
                            <input type="password" id="c_password1" name="c_password1" placeholder="Confirm your Password">
                        </div>
                        
                    </div>
                    <div class="sign_in_form_fill">
                        <label for="upgrade">ACC lv: ' . $accounts["acc_lv"] . ' || Request Account Upgrade:</label>
                        <div class="sign_in_form_fill_overlay">
                            <div class="overlay_18"></div><!-- Overlay -->
                            <select name="upgrade" id="upgrade">
                                <option value="">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="termsconds">
                        <input type="checkbox" id="check" required>
                        <p> You accept the <u><a href="">terms and conditions</a></u> and <br> <u><a href="">privacy policy.</a></u></p>
                    </div>
                    <div class="sign_in_form_button">

                        <div class="sign_in_form_button_overlay">
                            <div class="overlay_11"></div><!-- Overlay -->
                            <button type="button" onclick="UPback()">Back</button>
                        </div>

                        <div class="sign_in_form_button_overlay">
                            <div class="overlay_12"></div><!-- Overlay -->
                            <button type="submit">Update</button>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>
        </div><!-- Log In & Sign Up -->

    </div>

</body>
<footer>

</footer>
<script src="script/animation.js"></script>
</html>

        ';

    }


}





?>



