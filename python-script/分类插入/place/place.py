# -*- coding: utf-8 -*- 
import MySQLdb
import sys  
reload(sys)  
sys.setdefaultencoding('utf-8') 
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()
    myfile=open('place.txt','r')
    id=5000000
    priority=0
    for name in myfile:
        value=[id,priority,name]
        cur.execute('insert into place(id,priority,name) values(%s,%s,%s)',value)
        id=id+1
        priority=priority+1

    myfile.close()
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])