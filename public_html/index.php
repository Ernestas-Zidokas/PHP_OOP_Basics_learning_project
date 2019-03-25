<?php
require '../bootloader.php';

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$db->save();

$kokteilis = new \App\Item\Gerimas([
    'name' => 'Rutos dizzly kokteilis',
    'amount_ml' => 500,
    'abarot' => 11.00,
    'image' => 'images/banana.gif'
        ]);

$svyturio = new \App\Item\Gerimas([
    'name' => 'myzalas',
    'amount_ml' => 500,
    'abarot' => 5.00,
    'image' => 'images/svyturio.jpg'
        ]);
$vodka = new \App\Item\Gerimas([
    'name' => 'Absolut',
    'amount_ml' => 700,
    'abarot' => 40.00,
    'image' => 'images/absolut.jpg'
        ]);
$vanduo = new \App\Item\Gerimas([
    'name' => 'Neptunas',
    'amount_ml' => 1000,
    'abarot' => 0.00,
    'image' => 'images/neptunas.jpg'
        ]);

$model_gerimai = new App\model\ModelGerimai($db, 'kokteiliai');
$model_gerimai->insert('kokteilis', $kokteilis);
$model_gerimai->insert('svyturio', $svyturio);
$model_gerimai->insert('vodka', $vodka);
$model_gerimai->insert('vanduo', $vanduo);

//$model_gerimai->deleteRows();
?>
<html>
    <head>
        <title>OOP</title>
    </head>
    <body>
        <?php foreach ($model_gerimai->loadAll() as $gerimas): ?>
            <div>
                <p>Vardas: <?php print $gerimas->getName(); ?></p>
                <p>Abarotai: <?php print $gerimas->getAbarot(); ?></p>
                <p>Kiekis: <?php print $gerimas->getAmount(); ?></p>
                <img src="<?php print $gerimas->getImage(); ?>"
            </div>
        <?php endforeach; ?>
    </body>
</html>