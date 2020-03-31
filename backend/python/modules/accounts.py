#!/usr/bin/python

#
# Account Module - fetch api accounts
#

import os
import sys
import json
import requests



class Accounts:
    def __init__(self, url):
        self.url = url	

    def runtimeaccount(self):
    	print(self.url);
    	try:
        	r = requests.get(self.url, verify=False)
        	data = json.loads(r.text.encode('utf-8'))
        	return data 
        except requests.exceptions.ConnectionError:
        	print("Connection Refused");
        