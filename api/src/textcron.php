<?php

//include_once "/../vendor/autoload.php";
include "/var/www/vhosts/Butler/api/public/v1/firebase.php";
use Twilio\Rest\Client;

$bb = new ButlerBase();
$db = $bb->get_db();

$user_conf = $db->getReference("users")->orderByKey("name")->getSnapshot()->getValue();

foreach ($user_conf as $user) {
    $tasks = $user['tasks'];
    if (sizeof($tasks) > 0) {
        $min_time = min(array_keys($tasks));
        $time = min(array_keys($tasks)) - time();
        $time = $time / 60;
        if ($time < 5) {
            $result;
            $phone = $user['phone'];
            $message = $user['tasks'][$min_time]['task'];
            //$result = shell_exec("/usr/bin/python /var/www/vhosts/Butler/api/src/send_sms.py $phone '$message'");
            /*$sid = file_get_contents("account_sid.txt");
            $token = file_get_contents("auth_token.txt");
            $client = new Client($sid, $token);

            //try {
                $client->account->messages->create(
                "+17738291129",
                array(
                     "from" => "8722405562",
                     "body" => "ammar is a bitch"
                     )
                );
            //} catch (Exception $e) {
            //    echo $e->getMessage();
            //}
*/
            exec(escapeshellcmd("/usr/bin/sudo /usr/bin/python ".__DIR__."/send_sms.py $phone '$message'"));
            //$db->getReference("users/$phone/tasks/$min_time")->remove();
        }
    }
}

?>
