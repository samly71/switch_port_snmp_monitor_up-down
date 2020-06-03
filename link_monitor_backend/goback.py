#!/usr/bin/python
#-*- coding:utf-8 -*-
#Author: zengxl
#Date: 2020-05-31 23:12
#Content: check SNMP interface up/down

import os
import sys
import time
import db_info as db
import db_log_insert as db_log
from threading import Thread

sql = "select * from dev_iface"

res = db.db_select(sql)
num = int(len(res))

class Device:
   
    beizhu = "不知道写啥"
 
    def __init__(self,res):
        dev_name = res[1]
        dev_ip = res[2]
        dev_class = res[3]
        dev_snmp_com = res[4]
        dev_iface_class = res[5]
        dev_iface_slot = res[6]
        dev_iface_desc = res[7]
        dev_active = res[8]
        dev_remarks = res[9]
        res3 = "_" + str(res[0]) + "_" + str(dev_name) + "_" + str(dev_ip) + "_" + str(dev_class) + "_" + str(dev_snmp_com) + "_" + str(dev_iface_class) + "_" + str(dev_iface_slot) + "_" + str(dev_iface_desc) + "_" + str(dev_active) + "_" + str(dev_remarks) + "_"

        if int(dev_active) == 0:
            res1 = self.device_active(res,dev_name,dev_ip,dev_snmp_com,res3)
            if int(res1) == 1:
                self.device_iface_right(res,dev_name,dev_ip,dev_snmp_com,dev_iface_class,dev_iface_slot,res3)
                ret = "设备目前状态 snmp ok " + str(res3)
                
            else:
                pass

    def device_active(self,res,dev_name,dev_ip,dev_snmp_com,res3):
        str_res = "device no respone from down"
        cmd = "snmpwalk -c " + dev_snmp_com + " -v 2c " + dev_ip + " system -t 5 -r 3 | wc -l "
        res_live = os.popen(cmd).read()
        res_live = int(res_live)
        if res_live >=1 :
            ret = "device is live" + str(res3)
            db_log.write_log(ret,self.beizhu)
            return 1
        else:
            ret = "设备不可达，SNMP没有返回down" + str(res3) +"_" + str_res
            db_log.write_log(ret,self.beizhu)

    def device_iface_right(self,res,dev_name,dev_ip,dev_snmp_com,dev_iface_class,dev_iface_slot,res3):
        cmd = "snmpwalk -c " + dev_snmp_com + " -v 2c " + dev_ip + ' -t 5 -r 3 IF-MIB::ifDescr | grep ' + dev_iface_slot + '$ | grep " ' + dev_iface_class + '" | head -1 '
        res_getiface = os.popen(cmd).read()

        res_getiface = res_getiface.split()
        if len(res_getiface) >= 1 :

            ifdescr_index = res_getiface[0]
     
            get_index = ifdescr_index.split(".")
            get_index = get_index[-1]

            ifdescr_name = res_getiface[3]
            cmd = "echo " + ifdescr_name + '| tr [a-z][A-Z] "-" '
            res_ifaceNo = os.popen(cmd).read()
            ifdescr_name = (res_ifaceNo.split("-")[-1])
            ifdescr_name = ifdescr_name.strip()

            dev_iface_slot = dev_iface_slot.strip()
            get_index = get_index.strip()
            

            if dev_iface_slot == ifdescr_name:
                cmd = "snmpwalk -c " + dev_snmp_com + " -v 2c " + dev_ip + " -t 5 -r 3 IF-MIB::ifOperStatus." + get_index
                res_updown = os.popen(cmd).read() 
                res_updown = res_updown.split()[-1]
                res_updown = res_updown.split("(")[0]
                if res_updown == "down":
                    pass
                elif res_updown == "up":
                    ret = "no down 把这个接口重新修改为 dev_active 1 激活监控 goback " + str(res3)
                    db_log.write_log(ret,self.beizhu) 
                else:
                    ret = "监控的接口 非up 非down 未知道状态" + str(res3)
                    db_log.write_log(ret,self.beizhu)
            else:
                ret = "监控信息 与获取接口信息 接口不一致,排查接口类型down" + str(res3)
                db_log.write_log(ret,self.beizhu)
        else:
            ret = res3 + "_down_" + "检查 snmp是否频繁，导致拒绝，接口 类型&端口号是否正确"
            db_log.write_log(ret,self.beizhu)

if __name__ == "__main__":
    for ii in res:
        thread_num = Thread(target=Device,args=(ii,))
        thread_num.start()
