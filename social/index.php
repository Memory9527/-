<?php
require_once 'header.php';
echo "<br><span class='main'>Welcome to" . APP_NAME . ",";
if($loggedin) echo "$user,your are logeed in.";
else              echo "please signe up and/or log in to join in.";
?>
</span><br><br>
</body>
</html>
