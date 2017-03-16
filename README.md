# SCANX-The-Mini-Shodan
This tool used nmap and scanpbnj modules to develop a mini shodan type engine that can search according to any service running on the vairous hosts, It connects the nmap results to the database providing a proper frontend with an administrative panel.


########################################################
############### SCANX- The SubNet Scanner ##############
#####Developed by Shivam Mehta (www.shivammehta.me) ####
################# for Telesonic Networks Pvt Ltd #######
########################################################

Scanx is a utility for system admins to manage large number of systems in a Subnet.
The changes can be viewed using Front end
See point 10.) To how to add it to cron



--------------------------------------------------------
Steps :-
--------------------------------------------------------
1.) Download PBNJ Module From  http://pbnj.sourceforge.net/
then 
perl Makefile.PL
make
make test
** Then as root **
make install

2.)You will need to install the following modules for PBNJ 2.0 to work

YAML
DBI
DBD::SQLite
XML::Twig
Nmap::Parser
File::Which
Text::CSV_XS
File::HomeDir

Also, you will need Nmap (any version will do)

To install a module using CPAN

$ sudo cpan

# make sure you have the latest version of CPAN installed
cpan> install CPAN
cpan> install Bundle::CPAN

# then when you see the cpan> prompt type install and the name of
# the module

cpan> install Nmap::Parser

cpan> install File::HomeDir


3.) Install Apache and MySQL  or install a utility like xampp
	Copy Scanx-Backend into html/htdocs folder 


4.) Go to localhost/phpmyadmin and login in case of kali linux we have username: root pass:<blank> on localhost 
5.) Create The Following DB
	i.)  pbnj - leave it empty
	ii.) IPADDR - tablename IP with one column ip varchar 20 length
	iii.)users - tablename admin with 2 columns Uname (varchar length 20) Pass (varchar length 50)
		in users add Your Desired Username and Password to login into webserver
6.)Configure pbnj to use MySQL database
Setting up the configuration file


# cd
# mkdir -p .pbnj-2.0
# cp /usr/share/doc/pbnj/examples/mysql.yaml config.yaml

# nano config.yaml

Set the following configuration


# YAML:1.0
# Config for connecting to a DBI database 
# SQLite, mysql etc
db: mysql
# for SQLite the name of the file. For mysql the name of the database
database: pbnj
# Username for the database. For SQLite no username is needed.
user: root
# Password for the database. For SQLite no password is needed.
passwd: ""
# Password for the database. For SQLite no host is needed.
host: localhost
# Port for the database. For SQLite no port is needed.
port: 3306

*********************************************

Step #6: Scan and Query for Results
cd ~/
scanpbnj 192.168.1.0/24
... snipped ...
outputpbnj -q latestinfo
... snipped ...

*********************************************

Step #7: Verify your data is in the database:

# mysql   
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 15
Server version: 5.0.36-Debian_1-log Debian etch distribution

Type 'help;' or '\h' for help. Type '\c' to clear the buffer.


mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema | 
| mysql              | 
| pbnj               | 
| IPADDR             | 
| users              | 
+--------------------+

mysql> use pbnj;

mysql> select * from machines; 

mysql> select * from services; 



8.) Run Scanx-backend/mainfile.py To use Backend Options
9.) Go to Your Webbrowser and Run 127.0.0.1/Scanx/index.php and login with your users table's credentials to access Admin FrontEnd

10.) To add it to Cron job
go to crontab -e 
Add the following command in the End
0 */2 * * * /root/Desktop/cronfile.py   ->It will make it run every 2 hours

To check if it is added use crontab -l 



If Something is not write report the bugs/whatcha's to me email : shivam.mehta007@gmail.com will fix and help you asap :) 


All is done! Enjoy your Utility !



**NOTE**
If your Db is not allowing you Root access ! Change your username and password on config.yaml file and config.php , configdb.php , addip.php
