<?php

require '../bootloader.php';

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$db->save();

$kokteilis = new \App\Item\Gerimas([
    'name' => 'Rutos dizzly kokteilis',
    'amount_ml' => 500,
    'abarot' => 11.00
    ]);

$model_gerimai = new App\model\ModelGerimai($db, 'kokteiliai');
$model_gerimai->insert('kokteilis', $kokteilis);
?>
<html>
    <head>
        <title>OOP</title>
    </head>
    <body>
        Labas
    </body>
</html>