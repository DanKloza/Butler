<?php

$from = $_POST["From"];
$msg  = $_POST["Body"];

header('Content-Type: text/xml');

$matches = 0;
$result = array();

if (preg_match("/Remind me to (.*) at ([0-9][0-9]:[0-9][0-9])/i", $msg ,$result)) {
    $matches = 1;
}

?>

<Response>
    <Message>
        <?php echo ($matches) ? "OK! Will remind you to '{$result[1]}' at {$result[2]}" : "Sorry, I can't understand you. Can you be more clear?"
        ?>
    </Message>
</Response>
