#!/usr/bin python

from twilio.rest import TwilioRestClient
import sys

to_ = sys.argv[1]
msg_ = sys.argv[2]

print "MOTHERFUCKER";

with open('/var/www/vhosts/Butler/api/src/account_sid.txt', 'r') as myfile:
    account_sid=myfile.read().replace('\n', '')

with open('/var/www/vhosts/Butler/api/src/auth_token.txt', 'r') as myfile2:
    auth_token=myfile2.read().replace('\n', '')

client = TwilioRestClient(account_sid, auth_token);

#message = client.calls.create(to=to_, from_="+18722405562", url="https://butler.andrijko.com/v1/callredirect.php")
#message = client.message.create();
message = client.messages.create(to=to_, from_="+18722405562", body=msg_)
