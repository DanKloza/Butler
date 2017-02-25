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
    <Say>Hello <?php echo $name; ?></Say>
</Response>
