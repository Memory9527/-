<?php
session_start();
if (!$_SESSION['admin']){
    header('location:index.html');
}
require '../config.php';
require '../common/admin_header.php';
require '../mysql.class.php';

DB::connect();
$gb_count_sql='SELECT count(*) FROM ' . DB_TABLE_NAME;
$gb_res=mysqli_query(DB::$con,$gb_count_sql);
$gb_count=mysqli_fetch_row($gb_res)[0];
$page = isset($_GET['page'])?$_GET['page']:1;
//限制搜索结果
$offset = ($page-1)*PER_PAGE_GB;
//分页数
$page_sum = ceil($gb_count/PER_PAGE_GB);
if($page>$page_sum||$page<0){
    $page = 1;
}

$data_sql = 'SELECT * FROM ' . DB_TABLE_NAME .' ORDER BY createtime DESC LIMIT ' . $offset.' , ' . PER_PAGE_GB;
$data_res = mysqli_query(DB::$con,$data_sql);
if(!empty($data_res)){
    while($temp = mysqli_fetch_array($data_res)){
        $data_array[]=$temp;
    }
}
DB::close();
foreach($data_array as $k => $value) {
    echo '<tr class="all">';
    echo '<td class="center id">' . $value['id'] . '</td>';
    echo '<td class="center">' . $value['nickname'] . '</td>';
    echo '<td class="content">' . $value['content'] . '</td>';
    echo '<td class="center">' . $value['createtime'] . '</td>';
    echo '<td class="center">' . $value['status'] . '</td>';
    echo '<td class="content">' . (empty($value['reply']) ? 'no' : $value['reply']) . '</td>';
    echo '<td class="center">' . (empty($value['replytime']) ? 'no' : $value['replytime']) . '</td>';
    echo '<td>';
    echo (!empty($value['reply'])) ? '' : '<input type="button" class="replybox" value="replay"/>&nbsp;';
    echo '<input type="button" class="lock" value="' . ($value['status'] == "1" ? "unlock" : "lock") . '"/>';
}
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="8">总共' . $gb_count . '条留言';
if($page_sum>1){
    for($i=1;$i<=$page_sum;$i++){
        if($i==$page){
            echo '&nbsp;&nbsp;[' . $i . ']';
        }else{
            echo '<a href="?page='. $i .'">&nbsp;'. $i . '&nbsp;</a>';
        }
    }
}
echo '</td>';
echo '</tr>'
?>
</table>
<div class="footer">
    <h4 style="text-align: center"><a href="logout.php" > admin logout</a></h4>
</div>

</div>
<div id="hidden"></div>
<div id="reply">
    <div class="reply-header">
        <h4>Replay</h4>
        <input type="button" id="close" aria-hidden="true" value="&times;"/>
    </div>
    <div class="reply-body">
        <label for="reply-content">ReplayContent:</label>
        <input type="text" id="reply-content" name="reply" placeholder="内容(50个字符以内)" maxlength="50" />
        <input type="button" value="提交" id="sub">
        <input type="hidden" id="replyid">
    </div>
</div>
</body>
</html>


