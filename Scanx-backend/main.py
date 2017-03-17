#!/usr/bin/env python
import mysql.connector
from mysql.connector import Error
from os import system
from time import sleep

iplist = []  # used to have IP Adress


#
#           This Mehtod finds the IP adress from the database
#
#


def ipfinder():
    '''
    Takes Ip adress from ipadress.txt
    :return: None
    '''
    global iplist
    try:
        conn = mysql.connector.connect(host='localhost', database='IPADDR', user='root', passwd='toor')
        if conn.is_connected():
            cusor = conn.cursor()
            cusor.execute('SELECT IP FROM IP;')
            for value in cusor:
                if value not in iplist:
                    iplist.append(value[0])
    except Error as e:
        print 'Some Error Occured' + str(e)

    print "Number of IP adresses: "
    for ips in iplist:
        print ips


# This Module Runs the ScanPBNJ Function
#
#
#


def scanpbnj():
    '''
    Runs an Active System Scan
    :return: Scan Outputs
    '''
    print '''ScanPBNJ Module !
    [1] Add IP to the Scan Pool
    [2] Run Quick Scan ("-A -T4 -n")
    [3] Run Default Scan
    [4] Custom Parameter Scan
    [5] Go Back to Previous Menu
    Anything else exit'''
    a = input("[?] Enter your Choice: ")
    if a == 1:
        ipstring = raw_input("Enter Multiple IP's Separated by Space:")
        moreip = ipstring.split()
        try:
            conn = mysql.connector.connect(host='localhost', database='IPADDR', user='root', passwd='toor')
            if conn.is_connected():
                cusor = conn.cursor()
                for ip in moreip:
                    if ip not in iplist:
                        command = 'insert into IP(ip) values ("'+str(ip)+'")'
                        cusor.execute(command)
                        conn.commit()
                        print 'value added'
                    else:
                        print ip+ ': Already present'
            scanpbnj()
        except Error as e:
            print 'Some Error Occured' + str(e)


    if a == 2:
        for ip in iplist:
            print "[*] Running Command:"
            comnd = 'sudo scanpbnj -a "-A -T4 -n" ' + ip
            print comnd.lstrip()
            system(comnd)
    elif a == 3:
        for ip in iplist:
            print "[*] Running Command : "
            comnd = 'sudo scanpbnj ' + ip
            system(comnd)
    elif a == 4:

        print "[*] Running Command :"
        print "Format: scanpbnj <your parameters> "
        parms = raw_input("Enter Your Custom Parameters :")
        for ip in iplist:
            comnd = "sudo scanpbnj " + parms + " " + ip
            print comnd
            system(comnd)
    elif a == 5:
        menu()


#
#           This Module Runs the OutPut PBNJ Command
#
#


def outputpbnj():
    '''
    Used to Bring the Output of the PBNJ Commands
    :return: Various Fields and Outputs Result array
    '''
    global conn
    print "OutPut Modules"
    print '''
    [1] Whole Database Dump
    [2] Issue and Output PBNJ Module
    [3] List of all queries only
    [4] Return to main Menu
    Anything else to exit
                '''
    a = input("[?] Enter your Choice: ")
    if a == 1:
        try:
            conn = mysql.connector.connect(host='localhost',
                                           database='pbnj',
                                           user='root',
                                           password='toor')
            if conn.is_connected():
                cursor = conn.cursor()
                cursor.execute("SELECT * FROM machines as M,services as S where M.mid = S.mid ")
                print '| %15s  ' % 'IP' + '| %16s ' % 'OS' + '| %6s' % 'Port' + '| %12s' % 'Service' + '| %12s' % 'Banner' + '| %25s' % 'Created On' + '| %25s |' % 'Updated On'
                for value in cursor:
                    # for a in value:

                    print '| %15s ' % value[1] + " | %16s " % str(value[4]) + '| %6s' % str(value[10]) + '| %12s' % str(
                        value[8]) + '| %12s' % str(value[13][:12]) + '| %25s' % str(value[6]) + '| %25s |' % str(
                        value[15])
                    # print value



        except Error as e:
            print 'error'
            print(e)

        finally:
            conn.close()

    elif a == 2:
        inp = raw_input("Enter The Query to be Executed: ")
        com = 'sudo outputpbnj -q ' + inp + ' >output.txt'
#        print com
        system(com)
        Result = []
        file = open('output.txt', "r")
        for line in file:
            Result.append(line.strip())
            print line
        file.close()
    elif a == 3:

        system('sudo outputpbnj -n > options.txt')
        opfile = open("options.txt", "r")
        options = []
        for opts in opfile:
            options.append(opts.lstrip(" -"))
        finalopts = options[2:]
        print "The available options are :"
        for opts in finalopts:
            print opts.strip()

        outputpbnj()


    elif a == 4:
        menu()
    else:
        exit(1)


#
#               Empties the Database
#               Basically Drops the Tables
#




def dbchanges():
    '''
    Empties the current database
    :return: Empty Data
    '''
    try:
        conn = mysql.connector.connect(host='localhost',
                                       database='pbnj',
                                       user='root',
                                       password='toor')
        if conn.is_connected():
            print 'Connected to MySQL database:'
            cursor = conn.cursor()
            cursor.execute("DROP TABLE machines,services;")
            print "Database Emptied Successfully!"
            print 'Returning Back to Main Menu'
            sleep(2)




    except Error as e:
        print 'Error: '
        print(e)

    finally:
        print 'finally'
        conn.close()


#
#               Print the Main Menu
#
#

def menu():
    '''
    Prints the Command Menu Nothing Fancy :P
    :return: None
    '''
    system("clear")
    print '''
########################################################
********************************************************
	 		Scan-X
         Subnet IP Services Management System
********************************************************
########################################################
     Press the Option to Run:
     [1] New ScanPBNJ Command
     [2] New OutPut PBNJ Command
     [3] Drop the DB and Recreate Empty Database
     [4] Exit
             '''
    a = input("[?] Enter Your choice: ")
    if a == 1:
        scanpbnj()
    elif a == 2:
        outputpbnj()
    elif a == 3:
        dbchanges()
        print 'DB changes successful'
        menu()
    elif a == 4:
        exit(1)
    else:
        print "[-] Invalid input try again"
        menu()





#
#           Main Function Call
#
#

if __name__ == '__main__':
    ipfinder()
    menu()
