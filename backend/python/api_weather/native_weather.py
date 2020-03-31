#!/usr/bin/python


import sys
import json
import urllib
import pymysql
import requests
import datetime

# sys.path.append('/opt/homebrew/lib/python2.7/site-packages') # Replace this with the place you installed facebookads using pip
# sys.path.append('/opt/homebrew/lib/python2.7/site-packages/facebook_business-3.0.0-py2.7.egg-info') # same as above

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

# app_act = "act_10152681620922781"
# my_app_id = '381492199151679'
# my_app_secret = '475514e79fe8ce0bcd33d7668b7fbe0f'
# # my_access_token = 'EAAFa9xMD2D8BAD6UiFrGRQ6MyQHNCgrygAZAhbvNfDzJ2oGK0m2ZBRNQOjzdPyyZAUlIZChc2I7KsjiKWTL7ZBFTxItbnfjEXmaxHg6EuFhV9gqgAiLPNPiRWb0vHax1kmG58CDSlQosRCLtPIJu8flr3QPKBGop4qHYaJRE0agZDZD'
# my_access_token = 'EAAFa9xMD2D8BAOaJ1fWamzh09Vp3cfX0Riy01ptwixvuSIYWWSlQzapFg5ZB1TBPURHZCKfNGwE8XjRvxcEZAw6MEbr0DV5skPMfDoM2cIDdvtMGTzZBAEWRPmpfYo8an7XpEWmsODdLccA4rdkKu0ZAbzAJVg2SDBGw6T4ZAqagZDZD'
# # #print('\033c')

# hostname = 'localhost'
# username = 'root'
# password = 'Smuget1000'
# database = 'ppc_stats'
currentDT = datetime.datetime.now()


# def doQueryWeather(connW, c_name, c_campaign, c_weather, c_humidity, c_modifier) :
# 	print ("Service: inserting log into db")

#     #datetimenow = str(datetime.datetime.now())
# 	cur = connW.cursor()
# 	cur.execute("INSERT INTO weather_service(id, name, campaign, weather, city, modifier, moddate) VALUES('0','%s','%s', '%s', '%s','%s', '%s')" % (c_name, c_campaign, c_weather, c_humidity, c_modifier, str(currentDT)))
# 	connW.autocommit(True)


logger.Logger("Weather API CRON", "Weather API is used to modify AdSets according to weather").runtimelog()
facebookmodule.FacebookSDKInit().runtimeSDK()
data = accounts.Accounts("https://portal.synlighet.no/fb/accounts/").runtimeaccount()


logger.Logger("Weather API CRON", "Weather API is used to modify AdSets according to weather").runtimelog()
facebookmodule.FacebookSDKInit().runtimeSDK()
data = accounts.Accounts("https://portal.synlighet.no/fb/accounts/").runtimeaccount()

print(data);
for cu_data in data:
	print(cu_data['cid'])

print("APP RAN:")
print(str(currentDT))

# logger.Logger("Weather API CRON", "Weather API is used to modify AdSets according to weather").runtimelog()


# FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)


# FacebookAdsApi.init(my_app_id, my_app_secret, my_access_token)


# r = requests.get('http://213.162.241.217/fb_bidmod/json_accounts.php')
# data = json.loads(r.text.encode('utf-8'))

for cu_data in data:
	act_cid = "act_" + cu_data['cid']
	print("act_" + cu_data['cid'])

	if "weather" in cu_data['services']:
		print("found weather api")
		account = AdAccount(act_cid)
		campaigns = account.get_campaigns(fields=[
		    Campaign.Field.name,
		    Campaign.Field.configured_status,
		], params={
			'effective_status': ['ACTIVE'],
			'filtering':  [{'field':'name', 'operator':'CONTAIN','value':'Weather API'}], #set to SUMMER
		})

		for i in campaigns:
			c_value = campaigns
			

			temp_campaign = Campaign(i["id"])
			campaign_name = i["name"]
			print(temp_campaign, " campaing id")
			temp_campaign_str = i["id"]
			adsets = temp_campaign.get_ad_sets(fields=[
			    AdSet.Field.name,
			    AdSet.Field.id,
			    AdSet.Field.targeting,
			    AdSet.Field.daily_budget,
			    AdSet.Field.bid_adjustments,
			])

			for iAdSet in adsets:
					print("act_" + cu_data['cid'])

					print(iAdSet["daily_budget"])
					print(iAdSet["name"].encode('utf-8').strip())
					print(iAdSet["targeting"]["geo_locations"]["cities"][0]["name"], "sted")
					temp_city = iAdSet["targeting"]["geo_locations"]["cities"][0]["name"]
					
					if "\xf8" in temp_city.encode('utf-8'):
						print("found special char")
					else:
						print("all good")
					try:
						print(iAdSetCities2)
					
					except:
						try:
							print(iAdSet["targeting"]["geo_locations"]["cities"])
							for iAdSetCities in iAdSet["targeting"]["geo_locations"]["cities"]:

								apikey = '3603c8300aabd7684cbcf314b293bceb'
								cityOrg = iAdSetCities["name"].encode('UTF-8')


								city = urllib.quote(cityOrg)
								url = 'http://api.openweathermap.org/data/2.5/weather?q=' + cityOrg + ',' + "NO" + '&units=metric&appid=' + apikey #print(url)

								r = requests.get(url)
								r_y = json.dumps(r.json())
								data = json.loads(r_y)

								#print(r_y)
								w_clouds = data['clouds']['all']
								w_temp = data['main']['temp']
								w_windspeed = data['wind']['speed']
								w_mode = data['weather'][0]['description']
								w_city = data['name']
								w_humidity = data['main']['humidity']
								w_multiplier = "0.%s" % w_humidity
								adset_bid = int(iAdSet["daily_budget"])
								adset_multiplier = float(w_multiplier)

								print("city: ", w_city)
								print("mode: ", w_mode)

								adset_weather = iAdSet["name"].encode('utf-8').strip()
								print("weather: " + adset_weather)
								id = iAdSet["id"]
								if "Sol" in adset_weather: #rename adset_weather to adset_weather
									print(iAdSet["id"])

									if "clear" in w_mode:
										print("Start Sunny AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "ACTIVE")
									else:
										print("Pause AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'PAUSED',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "PAUSED")

								elif "Sno" in adset_weather:
									if "snow" in w_mode:
										print("Start AdSet")
										
										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
									else:
										print("Pause AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'PAUSED',},
										)

								elif "Regn" in adset_weather:

									if "rain" in w_mode:
										print("ohhh, what a rainy day it is..")
										print("Start AdSet")

										#if w_temp < 2:
										#	print("probably going to snow")
										#else:
										#	print("just rain")
										
										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
									elif "moderate rain" in w_mode:
                                        print("ohhh, what a rainy day it is..")
                                        print("Start AdSet")

                                        #if w_temp < 2:
                                        #	print("probably going to snow")
                                        #else:
                                        #       print("just rain")

                                        print AdSet(id).remote_update(
                                          params={'status': 'ACTIVE',},
                                        )
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "ACTIVE")
									elif "drizzle" in w_mode:
										print("ohhh, what a rainy day it is..")
										print("Start AdSet")
										
										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)

									if "drizzle" in w_mode:
										print("ohhh, what a rainy day it is..")
										print("Start AdSet")
										
										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "ACTIVE")

									else:
										print("Pause AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'PAUSED',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "PAUSED")
								elif "Vind" in adset_weather:

									print(iAdSet["id"])

									if w_windspeed >= 15:
										print("ohhh the wind is blowing me away..")
										print("Start AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "ACTIVE")
									elif "cloud" in w_mode:
										print("Start AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "ACTIVE")
									else:
										print("Pause AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'PAUSED',},
										)
										# doQueryWeather(connW, iAdSet["name"], campaign_name, w_mode, w_city, "PAUSED")

									if "cloud" in w_mode:
										print("Start AdSet")
									else:
										print("Pause AdSet")

								elif "Sno" in adset_weather:
									if "snow" in w_mode:
										print("Start AdSet")
										
										print AdSet(id).remote_update(
										  params={'status': 'ACTIVE',},
										)
									else:
										print("Pause AdSet")

										print AdSet(id).remote_update(
										  params={'status': 'PAUSED',},
										)
								print("")
								print("")
								print("")
						except:
							print("next...")
	else:
		print("found nothing")

print("")
print("")
print("APP FINISHED:")
currentDTEnd = datetime.datetime.now()
print(str(currentDTEnd))


