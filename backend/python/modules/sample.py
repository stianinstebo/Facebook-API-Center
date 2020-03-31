import logger
import accounts
import facebookmodule

# LOGGER MODULE
logger.Logger("Events API CRON", "Events API is used to modify AdSets according to events from competitors").runtimelog()

# ACCOUNTS MODULE
data = accounts.Accounts("http://213.162.241.217/fb_bidmod/json_accounts.php", "test").runtimeaccount()

# FACEBOOK MODULE
print(facebookmodule.FacebookSDKInit().runtimeSDK())