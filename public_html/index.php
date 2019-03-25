<?php
require '../bootloader.php';

$form = [
    'fields' => [
        'drink_name' => [
            'label' => 'Drink name',
            'type' => 'text',
            'placeholder' => 'Alkoholis 3000',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'drink_abarot' => [
            'label' => 'Drink abarot',
            'type' => 'float',
            'placeholder' => '5.0',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'drink_amount' => [
            'label' => 'Drink amount',
            'type' => 'number',
            'placeholder' => '500',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'drink_foto' => [
            'label' => 'Drink foto',
            'placeholder' => 'file',
            'type' => 'file',
            'validate' => [
                'validate_file'
            ]
        ]
    ],
    'buttons' => [
        'submit' => [
            'text' => 'Paduoti!'
        ]
    ],
    'callbacks' => [
        'success' => [
            'form_success'
        ],
        'fail' => []
    ]
];

function form_success($safe_input, $form) {
    $file_saved_url = save_file($safe_input['drink_foto']);
    var_dump($file_saved_url);
    $gerimas = new \App\Item\Gerimas([
        'name' => $safe_input['drink_name'],
        'amount_ml' => $safe_input['drink_abarot'],
        'abarot' => $safe_input['drink_amount'],
        'image' => $file_saved_url
    ]);
    var_dump($safe_input);
    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_gerimai = new App\model\ModelGerimai($db, 'input_kokteiliai');
    $model_gerimai->insert(date("Y-m-d-H:m:s"), $gerimas);
}

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

function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpg']) {
    var_dump('save file iskviestas');
    var_dump($file);
    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        var_dump('type is ok');
        $target_file_name = microtime() . '-' . strtolower($file['name']);
        $target_path = $dir . '/' . $target_file_name;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            var_dump('file moved');
            return $target_file_name;
        }
    }
    return false;
}

$success_msg = '';

if (!empty($_POST)) {
    $safe_input = get_safe_input($form);
    $form_success = validate_form($safe_input, $form);
    if ($form_success) {
        $success_msg = strtr('Gerimas "@drink_name" sėkmingai sukurtas!', [
            '@drink_name' => $safe_input['drink_name']
        ]);
    }
}
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
        <?php require '../core/views/form.php'; ?>
        <h3><?php print $success_msg; ?></h3>
    </body>
</html>