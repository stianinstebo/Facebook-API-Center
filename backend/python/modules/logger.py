#!/usr/bin/python

#
# Logger Module - logs runtime of python apps
#

import os
import sys
import pymysql
import datetime
import psutil

hostname = 'localhost'
username = 'root'
password = 'Smuget1000'
database = 'ppc_stats'
currentDT = datetime.datetime.now()

conn = pymysql.connect(host=hostname, user=username, passwd=password, db=database)

def doQuery(conn, p_process, p_name) :
		print ("Service: Inserting process log to database")

		pid = os.getpid()
		psutil_process = psutil.Process(pid)
		process_name = psutil_process.name() + " - " + sys.argv[0]

		cur = conn.cursor()
		cur.execute("INSERT INTO processlog(process, name, ran) VALUES('%s', '%s', '%s')"  % (pid, process_name, currentDT))
		conn.autocommit(True)
		conn.close()

class Logger:
    def __init__(self, process, name):
        self.process = process
        self.name = name		

    def runtimelog(self):
        doQuery(conn, self.process, self.name)