import mysql.connector
from mysql.connector import Error
from os import system

iplist=[]
try:
    conn = mysql.connector.connect(host='localhost', database='IPADDR', user='root', passwd='')
    if conn.is_connected():
        cusor = conn.cursor()
        cusor.execute('SELECT IP FROM IP;')
        for value in cusor:
            if value not in iplist:
                iplist.append(value[0])
except Error as e:
    print 'Some Error Occured' + str(e)

for i in iplist:
    comnd = 'scanpbnj -a "-A -T4 -n" ' + i
    print comnd.lstrip()
    system(comnd)