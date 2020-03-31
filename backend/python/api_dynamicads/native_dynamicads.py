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

from facebook_business.api import FacebookAdsApi
from facebook_business.adobjects.adaccount import AdAccount
from facebook_business.adobjects.campaign import Campaign
from facebook_business.adobjects.adset import AdSet
from facebook_business.adobjects.targeting import Targeting
from facebook_business.adobjects.ad import Ad
from facebook_business.adobjects.adcreative import AdCreative
from facebook_business.adobjects.adcreativeobjectstoryspec import AdCreativeObjectStorySpec

now = datetime.datetime.now()
dt_event_start = datetime.datetime
dt_event_created = datetime.datetime

# my_app_id = '381492199151679'
# # my_app_id = '2439697762917423'
# my_app_secret = '475514e79fe8ce0bcd33d7668b7fbe0f'
# # my_app_secret = '56c5a3abffcd0e8843da60de9a8fa3af'
# my_access_token = 'EAAFa9xMD2D8BAOaJ1fWamzh09Vp3cfX0Riy01ptwixvuSIYWWSlQzapFg5ZB1TBPURHZCKfNGwE8XjRvxcEZAw6MEbr0DV5skPMfDoM2cIDdvtMGTzZBAEWRPmpfYo8an7XpEWmsODdLccA4rdkKu0ZAbzAJVg2SDBGw6T4ZAqagZDZD'
# # my_access_token = 'EAAiq5GaEnC8BABZBZCIizbCaWt84Kat98vAVYnke18ZAqyc40xYfL52NIjC0xD6XQ84Rdr8ZAMhfRIsZBn8tBo6vDp0ZChjkpvuNg17l7fqgXzZASJc03oxIYFbYC2RrLcPNJvHdZCZAe7dDRTQuPOeeQdZAKKyOvceR9Oao7Pv0ZCZAulOSc1ZAXwmjHwNoyYPZCURUkZD'

# FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)

i = 0
# print data

# r = requests.get('http://213.162.241.217/fb_bidmod/json_accounts.php')
# data = json.loads(r.text.encode('utf-8'))

# logger.Logger("Dynamic Ads API CRON", "Dynamic Ads API is used to create ads according to input").runtimelog()

logger.Logger("Dynamic Ads API CRON", "Dynamic Ads API is used to modify AdSets according to relevant data pulled").runtimelog()
facebookmodule.FacebookSDKInit().runtimeSDK()
data = accounts.Accounts("https://portal.synlighet.no/fb/accounts/").runtimeaccount()

for cu_data in data:
	act_cid = "act_" + cu_data['cid']
	print("Account: ", act_cid)

	if "season" in cu_data['services']:
		print("found api")

		campaign = Campaign(parent_id=act_cid)
		campaign[Campaign.Field.name] = 'TEST - Product Catalog Sales Campaign'
		objective = Campaign.Objective.product_catalog_sales
		campaign[Campaign.Field.objective] = 'LINK_CLICKS'

		campaign.remote_create(params={
		    'status': Campaign.Status.paused,
		})

		print(campaign[Campaign.Field.id])


		# temp_campaign = Campaign(i["id"])
		# adsets = temp_campaign.adset(
		adset = AdSet(parent_id=act_cid)
		adset[AdSet.Field.name] = 'Product Catalog Sales Adset'
		adset[AdSet.Field.bid_amount] = 30
		adset[AdSet.Field.billing_event] = AdSet.BillingEvent.link_clicks
		adset[AdSet.Field.optimization_goal] = \
		    AdSet.OptimizationGoal.link_clicks
		adset[AdSet.Field.daily_budget] = 1000
		adset[AdSet.Field.campaign_id] = campaign[Campaign.Field.id]
		adset[AdSet.Field.targeting] = {
		    Targeting.Field.geo_locations: {
		        Targeting.Field.countries: ['NO'],
		    },
		}
		# adset[AdSet.Field.promoted_object] = {
		#     'product_set_id': '490354758419836',
		# }

		adset.remote_create()

		story = AdCreativeObjectStorySpec()
		story[story.Field.page_id] = 240295992766537
		story[story.Field.template_data] = {
		    'message': 'Test {{product.name | titleize}}',
		    'link': 'http://instebo.one',
		    'name': 'Headline {{product.price}}',
		    'description': 'Description {{product.description}}',
		}

		creative = AdCreative(parent_id=act_cid)
		creative[AdCreative.Field.name] = 'Dynamic Ad Template Creative Sample'
		creative[AdCreative.Field.object_story_spec] = story
		creative[AdCreative.Field.product_set_id] = 490354758419836
		creative.remote_create()

	else:
		print("no api found")