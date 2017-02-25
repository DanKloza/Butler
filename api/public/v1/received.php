<?php
include __DIR__."/firebase.php";

$first_time_user = 0;
$no_time_error = 0;
$bb = new ButlerBase();

$from = $_POST["From"];

$user = $bb->get_user($from);
if ($user == null) {
    $first_time_user = 1;
    $bb->create_user($from, "boss");
    $user = $bb->get_user($from);
}

$msg  = $_POST["Body"];

header('Content-Type: text/xml');

$matches = 0;
$result = array();

$timestamp;

if (preg_match("/Remind me to (.*) at (.*)/i", $msg ,$result)) {
    $matches = 1;
    $timestamp = strtotime($result[2]);
    if (!$timestamp) {
        $no_time_error = 1;
    }
    // add to db task
}

?>

<Response>
    <Message>
        <?php
        if ($matches) {
            if ($no_time_error) {
                echo "Sorry, I couldn't understand the time you requested.";
            } else {
                $bb->add_task_to_user($from, $result[1], $timestamp);
                echo "Okay! Will remind you to '{$result[1]}' at {$result[2]}";
            }
        } else {
            echo "Sorry, I can't understand you yet. Can you be more clear?";
        }
        ?>
    </Message>
</Response>
