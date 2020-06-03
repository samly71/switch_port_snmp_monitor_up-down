<!DOCTYPE html>
<html>
<head>
        <meta http-equiv="refresh" content="25" charset="UTF-8">
	<title>链路监控日志记录</title>
</head>

<style type="text/css">
.wrapper {width: 1080px;margin: 20px auto;}
h2 {text-align: center;}
.add {margin-bottom: 20px;}
.add a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
td {text-align: center;}
</style>

<body>
<div class="wrapper">
<h2>链路监控 告警日志记录</h2>
<div class="add">
<a href="index.php"> 返回 首页</a>
</div>

  <table width="1080" border="1">
      <tr>
		<th>ID</th>
		<th>日志记录时间</th>
		<th>日志内容</th>
		<th>备注</th>
		<th></th>
      </tr>

<?php
// 1.导入配置文件
require "db.php";
// 2. 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

// 3. 从DBNAME中查询到warn_log数据库，返回数据库结果集  
$sql = 'select * from warn_log order by datetime desc limit 30';
// 结果集
$result = mysql_query($sql,$link);
                
// var_dump($result);die;
// 解析结果集,$row为所有数据，$newsNum为数目
$newsNum=mysql_num_rows($result);  

for($i=0; $i<$newsNum; $i++){
    $row = mysql_fetch_assoc($result);
    echo "<tr>";
    $str1 = "up";
    $str2 = "live";
    $str3 = "ok";
    $str4 = "goback";
    if (strpos($row['log_content'],$str1))
    {
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['datetime']}</td>";
    echo "<td>{$row['log_content']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td><a href='javascript:del({$row['id']})'>删除</a></td>";
    echo "</tr>";
    }
    elseif(strpos($row['log_content'],$str2))
    {
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['datetime']}</td>";
    echo "<td>{$row['log_content']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td><a href='javascript:del({$row['id']})'>删除</a></td>";
    echo "</tr>";
    }
    elseif(strpos($row['log_content'],$str3))
    {
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['datetime']}</td>";
    echo "<td>{$row['log_content']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td><a href='javascript:del({$row['id']})'>删除</a></td>";
    echo "</tr>";
    }
    elseif(strpos($row['log_content'],$str4))
    {
    echo "<td>{$row['id']}</td>";
    echo "<td font size='3' color='green'>{$row['datetime']}</td>";
    echo "<td font size='3' color='green'>{$row['log_content']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td><a href='javascript:del({$row['id']})'>删除</a></td>";
    echo "</tr>";
    }
    else
    {
    echo "<td>{$row['id']}</td>";
    echo "<td><font size='3' color='red'>{$row['datetime']}</td>";
    echo "<td><font size='3' color='red'>{$row['log_content']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td>
    <a href='javascript:del({$row['id']})'>删除</a>
         </td>";
    echo "</tr>";
    }
			      }
// 5. 释放结果集
mysql_free_result($result);
mysql_close($link);
?>

</table>
</div>
	
<script type="text/javascript">
    function del (id) {
		  if (confirm("确定删除这条监控记录")){
		      window.location = "del_log_record.php?id="+id;
		      }
		}
</script>
</body>
</html>
