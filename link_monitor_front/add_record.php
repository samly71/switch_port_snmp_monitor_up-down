<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>增加记录</title>
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
<h2>链路监控 添加页面 </h2>
<div class="add">
    <a href="index.php">返回首页 链路管理平台</a>
</div


<form action="action_add_record.php" method="post">

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
