# -*- coding: utf-8 -*- 
import MySQLdb
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306)
    cur=conn.cursor()
    myfile=open('restaurant.txt','r')
    id=1000000
    for i in range(8000):
        read=myfile.readline()
        name=read.split('\t')[2]
        name=name.split('#')[0]
        if (i==0):
            name='taiwanjipai'
        phone=18800000000+id
        password=123456
        count=cur.execute("select id from restaurant where name=%s",name)
        if(count==0):
            value=[id,phone,name,password]
            cur.execute('insert into restaurant(id,phone,name,password) values(%s,%s,%s,%s)',value)
            id=id+1

    myfile.close()
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])