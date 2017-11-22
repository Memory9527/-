<?php
require_once 'header.php';
if(!$loggedin) die();
echo "<div class='main'>";
$following = array();
$followers = array();
$result = queryMysql("SELECT * FROM friends WHERE friend='$user'");
if($result->num_rows > 0){
    while($row=$result->fetch_assoc()){
         array_push($following,$row['user']);
    }

}

$result = queryMysql("SELECT * FROM friends WHERE user='$user'");
if($result->num_rows > 0){
    while($row=$result->fetch_assoc()){
        array_push($followers,$row['friend']);
    }
}

$mutual=array_intersect($followers,$following);
$followers =array_diff($followers,$mutual);
$following = array_diff($following,$mutual);

function show($friend){
    foreach($friend as $value){
        echo"<li><a href='members.php?view=".$value."'>" . $value . "</a></li>";
    }
    echo"</ul>";
}

if(!empty($mutual)||!empty($following)||!empty($followers)){
    //显示互相关注的用户
    if(!empty($mutual)){
        echo "<span class='subhead'>Your mutual friends</span><ul>";
        show($mutual);
    }
    //显示粉丝
    if(!empty($followers)){
        echo "<span class='subhead'>Your followers</span><ul>";
        show($followers);
    }
    //显示关注的用户
    if(!empty($following)){
        echo "<span class='subhead'>You are following</span><ul>";
        show($following);
    }

}else{
    echo "You don't have any friends yet.<br><br>";
}
?>
<a  class="button" href="messages.php">View Your messages</a>
<br>
<br>
</div>
</body>
</html>