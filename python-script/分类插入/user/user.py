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
    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
    print "Mysql Error %d: %s" % (e.args[0], e.args[1])