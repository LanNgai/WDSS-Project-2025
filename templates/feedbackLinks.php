<?php
if (!$_SESSION['IsAdmin']) {
    echo "<h1>Click here to go back to your <a href='http://localhost/WDSS-Project-2025/public/login/displayProfile.php'>profile</a></h1>";
} else {
    echo "<h1>Click here to go back to the <a href='http://localhost/WDSS-Project-2025/public/login/adminPage.php'>admin page!</a></h1>";
    echo "<h1>Click here to go <a href='http://localhost/WDSS-Project-2025/public/index.php'>Home</h1>";
}
