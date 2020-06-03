tips:
the platmon use the snmp mon the switch port up or down (down >>> warn)
本平台用SNMP监控 交换机switch port 的down，然后告警（有声音&页面提醒）

要点：
1. 准备LAMP环境 apache + mysql + python3.x ;下载完毕，注意给文件响应的权限；

1.5 可以考虑mysql 导入link_mon.sql 数据库（已经定义好数据库&表格）

2. link_monitor_backend 用于crontab计划任务（自定义）
*/3 * * * * /opt/link_monitor_backend/main.py
*/5 * * * * /opt/link_monitor_backend/gobackup.py

+link_monitor_backend
++ db_info.py 定义自己数据库主机/数据库账号/密码

3. link_monitor_front 页面展示放在/var/www/html/下
+link_monitor_front
++ db.php 定义自己数据库主机/数据库账号/密码

4. 保证步骤1；信息正确，启动；
   打开http://x.x.x.x/link_monitor/ 页面 添加 记录进行监控

########后续懂前端开发的，修正一下丑陋的页面
1.炫酷的前端页面；
2.分权 登录；
3.分页查看记录；
4.支持搜索显示;(补充）