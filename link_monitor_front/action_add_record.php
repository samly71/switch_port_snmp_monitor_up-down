<?php
// 处理编辑操作的页面 
require "db.php";
// 连接mysql
$link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
// 选择数据库
mysql_select_db(DBNAME,$link);
// 编码设置
mysql_set_charset('utf8',$link);

// 获取修改的监控记录
$id = $_POST['id'];
$dev_name = $_POST['dev_name'];
$dev_ip = $_POST['dev_ip'];
$dev_class = $_POST['dev_class'];
$dev_snmp_com = $_POST['dev_snmp_com'];
$dev_iface_class = $_POST['dev_iface_class'];
$dev_iface_slot = $_POST['dev_iface_slot'];
$dev_iface_desc = $_POST['dev_iface_desc'];
$dev_active = $_POST['dev_active'];
$remarks = $_POST['remarks'];
// 插入数据
mysql_query("insert into dev_iface (dev_name,dev_ip,dev_class,dev_snmp_com,dev_iface_class,dev_iface_slot,dev_iface_desc,dev_active,remarks)  values ('$dev_name','$dev_ip','$dev_class','$dev_snmp_com','$dev_iface_class','$dev_iface_slot','$dev_iface_desc','$dev_active','$remarks')",$link) or die('修改数据出错：'.mysql_error()); 

header("Location:index.php");  

?>
