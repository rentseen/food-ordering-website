# -*- coding: utf-8 -*-
from random import * 
import MySQLdb 
import chardet
import sys  
reload(sys)  
sys.setdefaultencoding('utf-8') 
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()
    
    id=4000000
    restaurant_id=1000000
    for j in range(4000):
        myfile=open('sender.txt','r')
        for i in myfile:
            if len(i)>5:
                line=i.split()
                name=line[1]
                phone=18800000000+id
                password=123456
                state=0
                value=[id,phone,name,restaurant_id,password,state]
                if(cur.execute('select * from restaurant where id=%s',restaurant_id)>0):
                    cur.execute('insert into sender(id,phone,name,restaurant_id,password,state) values(%s,%s,%s,%s,%s,%s)',value)
                id=id+1
        restaurant_id=restaurant_id+1
        myfile.close()
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])