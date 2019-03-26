<?php
require '../bootloader.php';
define('USER_DRINKS', 'input_kokteiliai');

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
    $file_saved_url = 'uploads/' . save_file($safe_input['drink_foto']);
    $gerimas = new \App\Item\Gerimas([
        'name' => $safe_input['drink_name'],
        'amount_ml' => $safe_input['drink_amount'],
        'abarot' => $safe_input['drink_abarot'],
        'image' => $file_saved_url
    ]);

    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_gerimai = new App\model\ModelGerimai($db, USER_DRINKS );
    $model_gerimai->insert(date("Y-m-d-H:m:s"), $gerimas);
}

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
//$model_gerimai = new App\model\ModelGerimai($db, 'kokteiliai');
$model_kokteiliai = new App\model\ModelGerimai($db, USER_DRINKS);

//$model_gerimai->insert('kokteilis', $kokteilis);
//$model_gerimai->insert('svyturio', $svyturio);
//$model_gerimai->insert('vodka', $vodka);
//$model_gerimai->insert('vanduo', $vanduo);

//$model_gerimai->deleteRows();

function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpg']) {
    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        $target_file_name = microtime() . '-' . strtolower($file['name']);
        $target_path = $dir . '/' . $target_file_name;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
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
        <?php foreach ($model_kokteiliai->loadAll() as $kokteilis): ?>
            <div>
                <h2>Vardas: <?php print $kokteilis->getName(); ?></h2>
                <p>Abarotai: <?php print $kokteilis->getAbarot(); ?></p>
                <p>Kiekis: <?php print $kokteilis->getAmount(); ?></p>
                <img src="<?php print $kokteilis->getImage(); ?>"
            </div>
        <?php endforeach; ?>
        <?php require '../core/views/form.php'; ?>
        <h3><?php print $success_msg; ?></h3>
    </body>
</html>