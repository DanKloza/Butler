<?php

exec("/usr/bin/python /var/www/vhosts/Butler/api/src/send_sms.py +17738291129 '{$_POST['Body']} from {$_POST['From']}'");

?>

