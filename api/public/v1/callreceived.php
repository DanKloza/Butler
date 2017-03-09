<?php
    include __DIR__."/firebase.php";
    $bb = new ButlerBase();

    //$from = $_POST["From"];

    //$user = $bb->findByPhoneNumber($from);
    $name = "Robbie";
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
<Reject reason="busy" />
    <!--<Say>Hello </Say>-->
    <!--<Dial>+17739547365</Dial>-->
    <!--<Play>http://www.youtubeinmp3.com/download/get/?i=k1MakL%2FYlh6KUtEHqyQlg9XwtUUWO</Play>-->
</Response>
