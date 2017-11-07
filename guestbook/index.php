
<?php require './common/header.php'; ?>
<div class="main">
    <div class="header">
        <h1>PHP 留言本</h1>
    </div>
    <div class="content">
 <?php
require 'config.php';
require 'mysql.class.php';
DB::connect();
$page = isset($_GET['page'])?intval($_GET['page']):1;
$gb_count_sql='SELECT count(*) FROM ' . DB_TABLE_NAME . ' WHERE status=0';
$gb_count_res=mysqli_query(DB::$con,$gb_count_sql);
$gb_count=mysqli_fetch_row($gb_count_res)[0];
$pagenum=ceil($gb_count/PER_PAGE_GB);
if($page>$pagenum||$page<0){
    $page=1;
}
//限制搜索结果
$offset =($page-1)*PER_PAGE_GB;

$pagedata_sql='SELECT nickname,content,email,createtime,reply,replytime FROM ' . DB_TABLE_NAME . '
 WHERE status=0 ORDER BY createtime DESC LIMIT '.$offset.','.PER_PAGE_GB;
$sql_page_result=mysqli_query(DB::$con,$pagedata_sql);

while($temp=mysqli_fetch_array($sql_page_result)){
    $sql_page_array[]=$temp;
}
DB::close();
if(!empty($sql_page_result)){
    foreach($sql_page_result as $key=>$value){
        echo '<div class="user">';
        echo '留言者: <span> '.$value['nickname'].' </span>'.(empty($value['email']) ? ''
                : '&nbsp;&nbsp;| &nbsp;&nbsp;邮箱:'.$value['email']);
        echo '<span class="right">时间: '.$value['createtime'].'</span>';
        echo '</div>';
        echo '<div class="guest">';
        echo '内容: '.$value['content'];
        echo '</div>';
        if(!empty($value['reply'])) {
            echo '<div class="replay">';
            echo '管理员回复: '.$value['reply'];
            echo ' <span class="right" > 回复时间：' . $value['replytime'] . '</span >';
            echo '</div >';
            }
        echo '<hr>';
    }
}
echo '共' . $gb_count . '条留言';
if($pagenum>1){
    for($i=1;$i<=$pagenum;$i++){
        if($i==$page){
            echo '&nbsp;&nbsp;[' . $i . ']';
        }else{
            echo '<a href="?page='. $i .'">&nbsp;' . $i . '&nbsp;</a>';
        }
    }
}
?>
</div>
    <div class="footer">
        <form  method="post" id="form">
            <ul>
                <li class="first">
                    <a href="#" class=" icon name"></a>
                    <input id="name" name="name" type="text" class="text"
                          maxlength="10" placeholder="Name" >
                    <div></div>
                </li>
                <li class="first">
                    <a href="#" class=" icon email"></a>
                    <input id="email" name="email" type="text" class="text" placeholder="Email" >
                    <div></div>
                </li>
                <li class="second">
                    <a href="" class="icon msg"></a>
                    <textarea id="Message" name="Message"
                             maxlength="50" placeholder="Contents"></textarea>
                    <div></div>
                </li>
            </ul>
            <input type="reset" value="Reset" id="reset">
            <input type="submit" value="Submit" id="sub">
            <div class="clear"></div>
        </form>
    </div>
</div>
</body>
</html>








