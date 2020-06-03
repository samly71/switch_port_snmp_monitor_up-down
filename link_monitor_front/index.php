<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>链路监控 后端管理平台系统</title>
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
<h2>链路监控 后端管理平台系统</h2>
<div class="add">
    <a href="add_record.php">增加监控记录</a>
    <a href="log_record.php">查看所有 日志记录</a>
    <a href="log_warn.php">查看最近 30条日志记录 异常标 红色</a>
    <a href="warning.php">查看最近 down日志记录</a> 
</div>
  <table width="1080" border="1">
      <tr>
		<th>ID</th>
		<th>设备名称</th>
		<th>设备ip_addr</th>
		<th>设备类型-厂家</th>
        	<th>SNMP团体名</th>
		<th>接口类型</th>
		<th>接口号</th>
		<th>接口描述</th>
		<th>该记录是否监控 0 1-是</th>
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

// 3. 从DBNAME中查询到news数据库，返回数据库结果集  
$sql = 'select * from dev_iface order by id desc ';
//$sql1= 'select count(*) from dev_iface order by id asc';
// 结果集
$result = mysql_query($sql,$link);
//$result1 = mysql_query($sql,$link);
                
// var_dump($result);die;
// 解析结果集,$row为所有数据，$newsNum为数目
$newsNum=mysql_num_rows($result);  

for($i=0; $i<$newsNum; $i++){
    $row = mysql_fetch_assoc($result);
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['dev_name']}</td>";
    echo "<td>{$row['dev_ip']}</td>";
    echo "<td>{$row['dev_class']}</td>";
    echo "<td>{$row['dev_snmp_com']}</td>";
    echo "<td>{$row['dev_iface_class']}</td>";
    echo "<td>{$row['dev_iface_slot']}</td>";
    echo "<td>{$row['dev_iface_desc']}</td>";
    echo "<td>{$row['dev_active']}</td>";
    echo "<td>{$row['remarks']}</td>";
    echo "<td>
    <a href='javascript:del({$row['id']})'>删除</a>
    <a href='edit_record.php?id={$row['id']}'>修改</a> 
         </td>";
    echo "</tr>";

//echo "<h3> 共计记录: {$result1}";
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
		      window.location = "del_record.php?id="+id;
		      }
		}
</script>
</body>
</html>
