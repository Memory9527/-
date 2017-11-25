<?php
require_once('header.php');
if(!$loggedin) die();

if(isset($_GET['view'])){
    $view = sanitizeString($_GET['view']);
}else{
    $view = $user;
}

//添加留言
if(isset($_POST['text'])){
    $text = sanitizeString($_POST['text']);
    if($text!="") {
        $pm = sanitizeString($_POST['pm']);
        $pm = substr($pm, 0, 1);
        $time = time();
        $sql = "INSERT INTO messages VALUES(Null,'$user','$view','$pm','$time','$text')";
        queryMysql($sql);
    }
}

//删除留言
if(isset($_GET['erase'])){
    $id = sanitizeString($_GET['erase']);
    $sql = "DELETE FROM messages WHERE id='$id'";
    queryMysql($sql);
}
//显示哪个用户的留言界面
if($view==$user){
    $name = "Your";
}else{
    $name = "<a href='members.php?view=$view'>$view</a>'s";
}

if($view !="") {
    echo "<div class='main'><h3>$name Message</h3>";
    showProfile($view);
    echo <<<END
    <form method='post' action='messages.php?view=$view'>
      Type here to leave a message:<br>
      <textarea name='text' cols='40' rows='3' required></textarea><br>
      Public<input type='radio' name='pm' value='0' checked='checked'>
      Private<input type='radio' name='pm' value='1'>
      <input type='submit' value='Post Message'>
      <input type='reset' value='reset'>
      </form><br>
END;
//查询留言
    $reslut = queryMysql("SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC");
    if($num=$reslut->num_rows){
        while($row=$reslut->fetch_assoc()){
            //显示公开的及用户相关的留言
            if($row['pm']==0||$row['auth']==$user||$row['recip']==$user){
                echo date("F j, Y, g:i a:",$row['time']);
                echo " <a href='messages.php?view=".$row['auth']."'>".$row['auth']."</a> ";
                if($row['pm'] == 0){
                    echo "wrote: &quot".$row['message']."&quot";
                }else {
                    echo "whispered:&quot<span class='whisper'>".$row['message']."&quot</span>";
                }
                if($row['recip']==$user){
                    echo "[<a href='messages.php?erase=".$row['id']."'>erase</a>]";
                }
                echo "<br>";
            }
        }
    }

}else{
    echo "<br><span class='info'>No messages yet</span><br>";
}
?>
</div>
</body>
</html>
