tips:
the platmon use the snmp mon the switch port up or down (down >>> warn)
��ƽ̨��SNMP��� ������switch port ��down��Ȼ��澯��������&ҳ�����ѣ�

Ҫ�㣺
1. ׼��LAMP���� apache + mysql + python3.x ;������ϣ�ע����ļ���Ӧ��Ȩ�ޣ�

1.5 ���Կ���mysql ����link_mon.sql ���ݿ⣨�Ѿ���������ݿ�&���

2. link_monitor_backend ����crontab�ƻ������Զ��壩
*/3 * * * * /opt/link_monitor_backend/main.py
*/5 * * * * /opt/link_monitor_backend/gobackup.py

+link_monitor_backend
++ db_info.py �����Լ����ݿ�����/���ݿ��˺�/����

3. link_monitor_front ҳ��չʾ����/var/www/html/��
+link_monitor_front
++ db.php �����Լ����ݿ�����/���ݿ��˺�/����

4. ��֤����1����Ϣ��ȷ��������
   ��http://x.x.x.x/link_monitor/ ҳ�� ��� ��¼���м��

########������ǰ�˿����ģ�����һ�³�ª��ҳ��
1.�ſ��ǰ��ҳ�棻
2.��Ȩ ��¼��
3.��ҳ�鿴��¼��
4.֧��������ʾ;(���䣩