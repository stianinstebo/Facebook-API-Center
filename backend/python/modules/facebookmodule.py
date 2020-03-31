#!/usr/bin/python

#
# Facebook SDK Module - init facebook marketing api account
#

import os
import sys
import json
import requests
from facebook_business.api import FacebookAdsApi

class FacebookSDKInit:
    def __init__(self):
    	status = 0		

    def runtimeSDK(self):
<<<<<<< HEAD
		my_app_id = ''
		my_app_secret = ''
		my_access_token = ''
=======
		my_app_id = ''
		my_app_secret = ''
		my_access_token = ''
>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609

		return FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)
