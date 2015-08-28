# -*- coding: utf-8 -*-
from random import * 
import MySQLdb 
import sys  
reload(sys)  
sys.setdefaultencoding('utf-8') 

try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()
    cur.execute('create table user(phone char(20),name char(50),password char(50),PRIMARY KEY(phone)) CHARACTER SET = utf8')
    cur.execute('create table sender(id char(20),phone char(20),name char(20),restaurant_id char(20),password char(50),state char(2),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table restaurant(id char(20),phone char(20),name char(100),password char(50),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table place(id char(20), priority char(11), name char(50),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table meal(id char(20),name char(20),price char(11),restaurant_id char(20),sale char(20),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table orderlist(id char(20),restaurant_id char(20),phone char(20),meal_id char(20),sender_id char(20),place_id char(20),state char(4),number char(5),remark char(100),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table sendersalary(id char(20), ordernumber char(20), salary char(20),PRIMARY KEY(id)) CHARACTER SET = utf8')
    cur.execute('create table comment(user_id char(20), meal_id char(20), comment char(200)) CHARACTER SET = utf8')


except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])
