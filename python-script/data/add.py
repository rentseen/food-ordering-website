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
    
    phone=18803000000
    myfile=open('user.txt','r')
    password=123456
    for i in myfile:
        if len(i)>5:
            line=i.split()
            name=line[1]      
            value=[phone,name,password]
            if(cur.execute('select * from user where phone=%s',phone)==0):
                cur.execute('insert into user(phone,name,password) values(%s,%s,%s)',value)
            phone=phone+1
    myfile.close()

    myfile=open('place.txt','r')
    id=5000000
    priority=0
    for name in myfile:
        value=[id,priority,name]
        cur.execute('insert into place(id,priority,name) values(%s,%s,%s)',value)
        id=id+1
        priority=priority+1
    myfile.close()


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
                value1=[id,phone,name,restaurant_id,password,state]
                value2=[id,0,0]
                if(cur.execute('select * from restaurant where id=%s',restaurant_id)>0):
                    cur.execute('insert into sender(id,phone,name,restaurant_id,password,state) values(%s,%s,%s,%s,%s,%s)',value1)
                    cur.execute('insert into sendersalary(id,ordernumber,salary) values(%s,%s,%s)',value2)
                id=id+1
        restaurant_id=restaurant_id+1
        myfile.close()


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
                    cur.execute('insert into meal(id,name,price,restaurant_id,sale) values(%s,%s,%s,%s,0)',value)
                id=id+1
        restaurant_id=restaurant_id+1
        myfile.close()



    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])