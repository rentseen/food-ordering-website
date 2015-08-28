# -*- coding: utf-8 -*- 
import MySQLdb
import sys  
from random import *
reload(sys)  
sys.setdefaultencoding('utf-8') 
 
try:
    conn=MySQLdb.connect(host='localhost',user='root',passwd='111111',db='food',port=3306,use_unicode=1, charset='utf8')
    cur=conn.cursor()

    id=60000000;
    cur.execute('select count(id) from meal')
    meal_number=cur.fetchone()[0]
    meal_number=meal_number/10
    cur.execute('select count(phone) from user')
    user_number=cur.fetchone()[0]
    cur.execute('select count(id) from place')
    place_number=cur.fetchone()[0]
    state=1
    remark="快送过来"

    for i in range(300000):
        if i%10000==0:
            print i
            conn.commit()
        meal_id=2000000+randrange(meal_number)
        cur.execute('select restaurant_id from meal where id=%s',meal_id)
        restaurant_id=int(cur.fetchone()[0])
        phone=18803000000+randrange(user_number)
        place_id=5000000+randrange(place_number)
        number=1+randrange(5)

        sender_list=[]
        sender_number=cur.execute('select id from sender where restaurant_id=%s',restaurant_id)
        sender_all=cur.fetchall()
        for j in range(sender_number):
            sender_list.append(int(sender_all[j][0]))
        sender_id=sender_list[randrange(sender_number)]

        value=[id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark]
        cur.execute('insert into orderlist(id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark) values(%s,%s,%s,%s,%s,%s,%s,%s,%s)',value)
        cur.execute('update meal set sale = sale + 1 where id = %s',meal_id)
        id=id+1

    state=0
    for i in range(10000):
        meal_id=2000000+randrange(meal_number)
        cur.execute('select restaurant_id from meal where id=%s',meal_id)
        restaurant_id=int(cur.fetchone()[0])
        phone=18803000000+randrange(user_number)
        place_id=5000000+randrange(place_number)
        number=1+randrange(5)

        value=[id,restaurant_id,phone,meal_id,place_id,state,number,remark]
        cur.execute('insert into orderlist(id,restaurant_id,phone,meal_id,place_id,state,number,remark) values(%s,%s,%s,%s,%s,%s,%s,%s)',value)
        cur.execute('update meal set sale = sale + 1 where id = %s',meal_id)
        id=id+1

    state=2
    for i in range(10000):
        meal_id=2000000+randrange(meal_number)
        cur.execute('select restaurant_id from meal where id=%s',meal_id)
        restaurant_id=int(cur.fetchone()[0])
        phone=18803000000+randrange(user_number)
        place_id=5000000+randrange(place_number)
        number=1+randrange(5)

        sender_list=[]
        sender_number=cur.execute('select id from sender where restaurant_id=%s',restaurant_id)
        sender_all=cur.fetchall()
        for j in range(sender_number):
            sender_list.append(int(sender_all[j][0]))
        sender_id=sender_list[randrange(sender_number)]

        value=[id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark]
        cur.execute('insert into orderlist(id,restaurant_id,phone,meal_id,sender_id,place_id,state,number,remark) values(%s,%s,%s,%s,%s,%s,%s,%s,%s)',value)
        cur.execute('update meal set sale = sale + 1 where id = %s',meal_id)
        cur.execute('update sendersalary set ordernumber = ordernumber + 1 where id = %s',sender_id)
        id=id+1

    conn.commit()
    cur.close()
    conn.close()
except MySQLdb.Error,e:
     print "Mysql Error %d: %s" % (e.args[0], e.args[1])