#!/usr/bin/env python
#-*- coding:utf-8 -*-
#Author: zengxl
#Date: 2020-05-31

import pymysql

host="localhost"
db = pymysql.connect(host, "root", "123456", "link_mon", charset='utf8' )
cursor = db.cursor()
tables = "dev_iface"

#sql = "select * from " + tables

def db_select(sql):
    try:
        cursor.execute(sql)
        db.commit()
        res = cursor.fetchall()
    except:
        db.rollback()
    db.close()
    return res


