<?php

require_once 'header.php';
if (!$loggedin) die();
echo "<div class='main'>";
//不同用户显示不同名称
if(isset($_GET['view'])){
    $view = sanitizeString($_GET['view']);
    if($view == $user)  $name = "Your";
    else $name = "$view's";
    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<div style='clear: both'></div>";
    echo "<a class='button' href='messages.php?view=$view'>".
         "View $name messages</a><br><br>";
         die("</div></body></html>");
}
//增加
if(isset($_GET['add'])){
    $add = sanitizeString($_GET['add']);
    $result1 = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    if(!$result1->num_rows)
        queryMysql("INSERT INTO friends VALUES('$add','$user')");
}else if($_GET['remove']){
        $remove = sanitizeString($_GET['remove']);
        queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}

//显示其他成员
$result = queryMysql("SELECT user FROM members ORDER  BY user");
$num = $result->num_rows;
echo "<h3>Other Members</h3><ul>";
for ($i=0;$i<$num;$i++){
    $row=$result->fetch_array(MYSQLI_ASSOC);
    if($row['user']==$user) continue;
    echo "<li><a href='members.php?view=".
        $row['user']."'>".$row['user']."</a>";
    $follow ="follow";
    //查询已关注的用户
    $result1 = queryMysql("SELECT * FROM friends WHERE user='".$row['user']."' AND friend='$user'");
    $t1 = $result1->num_rows;
    //查询粉丝
    $result2 = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='".$row['user'] ."'");
    $t2 = $result2->num_rows;

    if($t1+$t2>1) echo " &harr; is a mutual friend";
    else if($t1)  echo " &larr; you are following";
    else if($t2)  {echo " &rarr; is following you"; $follow="recip";}
    if($t1) echo "[<a href='members.php?remove=" .$row['user'] ."'>drop</a>]";
    else    echo "[<a href='members.php?add=" .$row['user'] ."'>".$follow."</a>]";
}
?>
</li>
</ul>
</div>
</body>

