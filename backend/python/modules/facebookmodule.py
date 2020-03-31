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
		my_app_id = '2617980854913762'
		my_app_secret = '1c20f679fafb3b03ce162a4a886220ae'
		my_access_token = 'EAAlNCiriyuIBAHoQZA7WeeIrXkdGgHYD1xqNdoHAVcp1HVqSYQcRZATNySXDvF2ZCfaEkqbzaFfz9C975LagD7VyAMqfyZBAnU5qjnOe8xmOB3fe6liJ9p875BlQotLZADO49pyMP14RQfmMBOAykWrGSwgKLk2UbpHQUbNByGoZAMU6srurmqKn6d2N4RRHcZD'
=======
		my_app_id = '381492199151679'
		my_app_secret = '475514e79fe8ce0bcd33d7668b7fbe0f'
		my_access_token = 'EAAFa9xMD2D8BACEBnw92nqErI4BZBxSYalWGeBAM9feWFlXDRg6YeX8qJiVnJ79YonV5ZBGokHk01dbJuQba0FjBDtum5omkK37OcJPcbO2CHOTCIDhBbbHjJXVxZCPav0oyCECMKQeSnCRLYYIe3I8z8BccZB9Yq6dipRAUewZDZD'
>>>>>>> d050fcacf2240d7cd453e7c1bbe98685fd589609

		return FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)