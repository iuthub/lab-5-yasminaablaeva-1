<?php
    if($_SERVER["REQUEST_METHOD"] != 'POST') {
        die("This page receives only POST requests :(");
    }
    $correct =
        isset($_REQUEST["name"]) && $_REQUEST["name"] &&
        isset($_REQUEST["section"]) && $_REQUEST["section"] &&
        isset($_REQUEST["card"]) && $_REQUEST["card"] &&
        isset($_REQUEST["card-type"]) && $_REQUEST["card-type"];

    if($correct) {
        $name = $_REQUEST["name"];
        $section = strtoupper($_REQUEST["section"]);
        $card = $_REQUEST["card"];
        $card_type = $_REQUEST["card-type"];

        $file = fopen('suckers.txt', 'a');
        fwrite($file, "$name; $section; $card; $card_type    ;;;sep;;;    ");
        fclose($file);
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Buy Your Way to a Better Education!</title>
    <link href="buyagrade.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php if($correct) { ?>
    <h1>Thanks, sucker!</h1>

    <p>Your information has been recorded!</p>

    <div>
        <dl>
            <dt>Name</dt>
            <dd>
                <?= $name ?>
            </dd>

            <dt>Section</dt>
            <dd>
                <?= $section ?>
            </dd>

            <dt>Credit Card</dt>
            <dd>
                <?= "$card ($card_type)" ?>
            </dd>
        </dl>
    </div>

    <p>Here are all suckers submitted there</p>
    <ul>
        <?php
        $lines = explode('    ;;;sep;;;    ', file_get_contents('suckers.txt'));
        foreach($lines as $line) { if ($line) {?>
            <li><pre><?= $line ?></pre></li>
        <?php }} ?>
    </ul>
<?php } else { ?>
    <h1>Sorry</h1>
    <p>Your didn't fill the form correctly. <a href="http://localhost/webpage/buyagrade.html">Try again?</a></p>
<?php } ?>
</body>
</html>