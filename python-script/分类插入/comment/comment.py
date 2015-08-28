# -*- coding: utf-8 -*- 
import MySQLdb
import sys  
from random import *
reload(sys)  
sys.setdefaultencoding('utf-8') 
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()

    for i in range(0,320000,2):
        cur.execute('update orderlist set if_comment=1 where id=%s ',60000000+i)
        cur.execute('select meal_id,phone from orderlist where id=%s ',60000000+i)
        res=cur.fetchone()
        meal_id=str(res[0])
        phone=str(res[1])
        value=[phone,meal_id,"初始插入评论"]
        cur.execute('insert into comment(user_id,meal_id,comment) values(%s,%s,%s)',value)
        if i%1000==0:
            print i
            conn.commit()
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])