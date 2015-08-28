# -*- coding: utf-8 -*- 
import MySQLdb
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306)
    cur=conn.cursor()

    cur.execute("delete from comment where user_id>0")
    
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])