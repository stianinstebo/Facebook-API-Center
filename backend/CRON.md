# CRONTAB -l

- */2 * * * * /usr/bin/python /var/www/html/fb_bidmod/2/backend/python/api_events/native_events.py >> /var/www/html/fb_bidmod/2/backend/logs/log_events.txt

- */2 * * * * /usr/bin/python /var/www/html/fb_bidmod/2/backend/python/api_seasons/native_seasons.py >> 
/var/www/html/fb_bidmod/2/backend/logs/log_seasons.txt

- */2 * * * * /usr/bin/python /var/www/html/fb_bidmod/2/backend/python/api_weather/native_weather.py >> 
/var/www/html/fb_bidmod/2/backend/logs/log_weather.txt
