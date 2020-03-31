#!/usr/bin/python

import sys
import urllib
import json
import requests
import datetime

sys.path.insert(1, '/var/www/html/fb_bidmod/2/backend/python/modules/')
import accounts
import logger
import facebookmodule

# from facebook_business.api import FacebookAdsApi
# from facebook_business.adobjects.adaccount import AdAccount
# from facebook_business.adobjects.campaign import Campaign
# from facebook_business.adobjects.adset import AdSet
# from facebook_business.adobjects.targeting import Targeting
# from facebook_business.adobjects.ad import Ad

now = datetime.datetime.now()
dt_event_start = datetime.datetime
dt_event_created = datetime.datetime

logger.Logger("Events API CRON", "Events API is used to modify AdSets according to events from competitors").runtimelog()
facebookmodule.FacebookSDKInit().runtimeSDK()
data = accounts.Accounts("https://portal.synlighet.no/fb/accounts/").runtimeaccount()

# my_app_id = '381492199151679'
# my_app_secret = '475514e79fe8ce0bcd33d7668b7fbe0f'
# my_access_token = 'EAAFa9xMD2D8BAOaJ1fWamzh09Vp3cfX0Riy01ptwixvuSIYWWSlQzapFg5ZB1TBPURHZCKfNGwE8XjRvxcEZAw6MEbr0DV5skPMfDoM2cIDdvtMGTzZBAEWRPmpfYo8an7XpEWmsODdLccA4rdkKu0ZAbzAJVg2SDBGw6T4ZAqagZDZD'

# FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)

data_cities = ['Bergen', 'Oslo', 'Trondheim']
i = 0

for cu_data in data:
	act_cid = "act_" + cu_data['cid']
	print("Account: ", act_cid)

	if "event" in cu_data['services']:
		print("found event api")

		account = AdAccount(act_cid)
		campaigns = account.get_campaigns(fields=[
		    Campaign.Field.name,
		    Campaign.Field.configured_status,
		], params={
			'effective_status': ['ACTIVE'],
			'filtering':  [{'field':'name', 'operator':'CONTAIN','value':'Events API'}],
		})

		for i in campaigns:
			c_value = campaigns

			temp_campaign = Campaign(i["id"])
			campaign_name = i["name"]
			# print(temp_campaign, " campaing id")

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
					
					url = "https://www.eventbriteapi.com/v3/events/search/?q=Schibsted&sort_by=best&location.address=%s&token=2KG6HOGFZKLPOSRPGC4O" % ad_city.encode('utf-8')
					print(url)

					response = urllib.urlopen(url)
					data = json.loads(response.read())

					for row in data['events']:
						event_name = row['name']['text']
						event_created = row['created']
						event_start = row['start']['local']
						event_end = row['end']['local']

						dt_event_start = dt_event_start.strptime(event_start[:-9], "%Y-%m-%d")
						dt_event_created = dt_event_created.strptime(event_created[:-10], "%Y-%m-%d")

						print(event_name)
						print("now: " + now.strftime("%Y-%m-%d"))
						print("created: " + dt_event_created.strftime("%Y-%m-%d"))
						print(now.strftime("%Y-%m-%d"))

						if now.strftime("%Y-%m-%d") >= dt_event_created.strftime("%Y-%m-%d"):
							
							if now.strftime("%Y-%m-%d") >= dt_event_start.strftime("%Y-%m-%d"):
								#pause adset
								print("Pause adset")
							else: 
								print("higher")
								print("Bli med paa kurs: ", dt_event_start.day, dt_event_start.strftime("%B"))
								print("enable adsets")
								print("end date set: ", dt_event_start.strftime("%Y-%m-%d"))
						else:
							print("pauset")
	else:
		print("found nothing")