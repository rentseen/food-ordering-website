# -*- coding: utf-8 -*-
from random import * 
import MySQLdb 
import sys  
reload(sys)  
sys.setdefaultencoding('utf-8') 

try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()
    cur.execute('drop table user')
    cur.execute('drop table sender')
    cur.execute('drop table restaurant')
    cur.execute('drop table place')
    cur.execute('drop table meal')
    cur.execute('drop table orderlist')
    cur.execute('drop table sendersalary')
    cur.execute('drop table comment')

except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])
