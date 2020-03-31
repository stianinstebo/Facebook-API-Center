#!/usr/bin/python

import sys
import urllib
import json
import requests
import datetime

from facebook_business.api import FacebookAdsApi
from facebook_business.adobjects.adaccount import AdAccount
from facebook_business.adobjects.campaign import Campaign
from facebook_business.adobjects.adset import AdSet
from facebook_business.adobjects.targeting import Targeting
from facebook_business.adobjects.ad import Ad

sys.path.insert(1, '/var/www/html/fb_bidmod/2/backend/python/modules/')
import accounts
import logger
import facebookmodule

now = datetime.datetime.now()

start_spring = "03-20"
start_summer = "06-21"
start_fall = "09-23"
start_winter = "12-21"

logger.Logger("Weather API CRON", "Weather API is used to modify AdSets according to weather").runtimelog()
facebookmodule.FacebookSDKInit().runtimeSDK()
data = accounts.Accounts("https://portal.synlighet.no/fb/accounts/").runtimeaccount()

for cu_data in data:
	act_cid = "act_" + cu_data['cid']
	act_season = ""
	print("Account: ", act_cid)

	if "season" in cu_data['services']:
		print("found season api")
		if start_winter <= now.strftime("%m-%d") <= start_spring:
			print("in between winter and spring")
			act_season = "winter"

		elif start_spring <= now.strftime("%m-%d") <= start_summer:
			print("in between spring and summer")
			act_season = "spring"

		elif start_summer <= now.strftime("%m-%d") <= start_fall:
			print("in between summer and fall")
			act_season = "summer"

		elif start_fall <= now.strftime("%m-%d") <= start_winter:
			print("in between fall and winter")
			act_season = "fall"

		else:
			print("Ohh, random error?")
	else:
		print("no season api activated")

	account = AdAccount(act_cid)
	campaigns = account.get_campaigns(fields=[
	    Campaign.Field.name,
	    Campaign.Field.configured_status,
	], params={
		'effective_status': ['ACTIVE'],
		'filtering':  [{'field':'name', 'operator':'CONTAIN','value':'Seasons API'}],
	})

	for i in campaigns:
		c_value = campaigns

		temp_campaign = Campaign(i["id"])
		campaign_name = i["name"]
		print(temp_campaign, " campaing id")

		adsets = temp_campaign.get_ad_sets(fields=[
		    AdSet.Field.name,
		    AdSet.Field.id,
		    AdSet.Field.targeting,
		    AdSet.Field.daily_budget,
		    AdSet.Field.bid_adjustments,
		])

		for iAdSet in adsets:

				print(iAdSet["name"].encode('utf-8'))
				ad_city = iAdSet["targeting"]["geo_locations"]["cities"][0]["name"]
				if act_season in iAdSet["name"].encode('utf-8'):
					print("starting AdSet")

				else:
					print("pausing AdSet")