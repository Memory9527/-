<?php
    require_once 'header.php';
echo <<<_END
<script>
function checkUser(user)
    {
      if (user.value == '')
      {
        O('info').innerHTML = ''
        return
      }
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              O('info').innerHTML = this.responseText
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }
</script>
<div class='main'><h3>Please enter your details to sign up</h3>
_END;

$error = $user = $pass = "";
if(isset($_SESSION['user']){
	$_SESSION=array();
	if(session_id()!="" || isset($_COOKIE[session_name()]))
		setcookie(session_name(),'',time()-2592000,'/');
	session_destroy();
}
if(isset($_POST['user'])){
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $pass = md5($pass);

    if($user == '' || $pass == '')
        $error = "Not all fields were entered<br><br>";
    else{
        $result= queryMysql("SELECT * FROM members WHERE user='$user'");
        if($result->num_rows)
            $error = "That username already exists<br><br>";
        else{
            queryMysql("INSERT INTO members VALUES('$user','$pass')");
            die("<h4>ACCOUNT CREATE </h4>Please Log in<br><br>");

        }

    }
}
echo <<<_END
    <form method='post' action='signup.php'>$error
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'
    onBlur='checkUser(this)' /><span id='info'></span><br>
    <span class='fieldname'>Password</span>
    <input type="password" maxlength='16' name='pass' value='$pass' />
    <br>
_END;

?>
<span class="fieldname">&nbsp;</span>
<input type="submit" value="Sign up">
</form></div><br>
</body>
</html>
