# -*- coding: utf-8 -*-
from random import * 
import MySQLdb 
import sys  
reload(sys)  
sys.setdefaultencoding('utf-8') 
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()
    
    id=2000000
    restaurant_id=1000000
    for j in range(4000):
        myfile=open('meal.txt','r')
        for i in myfile:
            if len(i)>5:
                line=i.split('\t')
                name=line[3]
                price=int(10+30*random())
                value=[id,name,price,restaurant_id]
                if(cur.execute('select * from restaurant where id=%s',restaurant_id)>0):
                    cur.execute('insert into meal(id,name,price,restaurant_id) values(%s,%s,%s,%s)',value)
                id=id+1
        restaurant_id=restaurant_id+1
        myfile.close()

    
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])