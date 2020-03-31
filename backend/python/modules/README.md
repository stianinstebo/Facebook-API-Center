# Teknisk dokukmentasjon moduler
### Python - Hvordan sette opp modulene i nytt script
1. Importer sys
2. Inkluder modul path (sys.path.insert(1, '/var/www/html/fb_bidmod/2/backend/python/modules/'))
3. Import modulene som normalt (import accounts, import logger)

## Logger Module
Logger modulen inkluderes i alle nye python programmer. Dette for å enkelt kunne få oversikt over processene og API'ene som blir kjørt. På denne måten kan vi enkelt holder oversikt.

### For å kjøre Logger modulen gjør du følgende:
1. Legg til en ny import. Importer modul 'logger' (import logger)
2. Call logger() 'logger.Logger("Prosessnavn", "Log comment").runtimelog()'

Merk at innholdet i selve call funskjonen ikke har noe og si; og er mer for debug enn prod kode.
Modulen henter automatisk PID og PID().name fra Linux import OS

* Modulen er basert på pymysql, psutil og datetime (import)
* Modulen er backward comp på py2 samt py3 (så langt pip import tillater oss)


## Accounts Module
Accounts modulen gjør det mulig å calle kontoinformasjon fra Python på en linje. Dette er gjort for å få bedre ytelse, samt universal implementering.

### For å kjøre Accounts modulen gjør du følgende:
1. Legg til ny import. Importer modul 'accounts' (import accounts)
2. Call accounts() 'data = accounts.Accounts("http://213.162.241.217/fb_bidmod/json_accounts.php", "test").runtimeaccount()'
3. Legg inn 'for loop' (for cu_data in data:)


## Facebook Module
Facebook Module er en samlet modul som inneholder informasjonen vi trenger for å calle på Facebook Python SDK

### For å kjøre Facebook modulen gjør du følgende:
1. Legg til ny import. Importer modul 'facebookmodule' (import facebookmodule)
2. Call facebookmodule() 'facebookmodule.FacebookSDKInit().runtimeSDK()'
3. Kjør normale calls i henhold til Facebook SDK

## Module