<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改记录</title>
</head>
<body>
<?php
    require "db.php";

    $link = @mysql_connect(HOST,USER,PASS) or die("提示：数据库连接失败！");
    mysql_select_db(DBNAME,$link);
    mysql_set_charset('utf8',$link);
    
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM dev_iface WHERE id=$id",$link);
    $sql_arr = mysql_fetch_assoc($sql); 

?>

<form action="action_edit_record.php" method="post">
<label>ID: </label><input type="text" name="id" value="<?php echo $sql_arr['id']?>">
<p>
<label>设备名称：</label><input type="text" name="dev_name" value="<?php echo $sql_arr['dev_name']?>">
<p>
<label>设备ip_addr：</label><input type="text" name="dev_ip" value="<?php echo $sql_arr['dev_ip']?>">
<p>
<label>设备类型-厂家：</label><input type="text" name="dev_class" value="<?php echo $sql_arr['dev_class']?>">
<p>
<label>SNMP团队名：</label><input type="text" name="dev_snmp_com" value="<?php echo $sql_arr['dev_snmp_com']?>">
<p>
<label>接口类型：</label><input type="text" name="dev_iface_class" value="<?php echo $sql_arr['dev_iface_class']?>">
<p>
<label>接口号：</label><input type="text" name="dev_iface_slot" value="<?php echo $sql_arr['dev_iface_slot']?>">
<p>
<label>接口描述：</label><input type="text" name="dev_iface_desc" value="<?php echo $sql_arr['dev_iface_desc']?>">
<p>
<label>是否监控：</label><input type="text" name="dev_active" value="<?php echo $sql_arr['dev_active']?>">
<p>
<label>备注：</label><input type="text" name="remarks" value="<?php echo $sql_arr['remarks']?>">
<p>
<input type="submit" value="提交">
</form>

</body>
</html>
