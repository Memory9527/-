<?php
//用户注销
require_once 'header.php';
if(isset($_SESSION['user'])) {
    $_SESSION = array();
    if (session_id() != "" || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }
    header("location:login.php");
}else{
    echo "<div class='main'><br>".
        "You cannot log out because you are not loged in";
}
?>
</div>
</body>
</html>
