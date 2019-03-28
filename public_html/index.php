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
                'validate_is_number'
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
    'validate' => [
        'validate_form_file'
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

function validate_form_file(&$safe_input, &$form) {
    $file_saved_url = save_file($safe_input['drink_foto']);
    if ($file_saved_url) {
        $safe_input['drink_foto'] = 'uploads/' . $file_saved_url;
        return true;
    } else {
        $form['error_msg'] = 'Jobans/a tu buhurs/gazele nes failas supistas!';
    }
}

function form_success($safe_input, $form) {
    $gerimas = new \App\Item\Gerimas([
        'name' => $safe_input['drink_name'],
        'amount_ml' => $safe_input['drink_amount'],
        'abarot' => $safe_input['drink_abarot'],
        'image' => $safe_input['drink_foto']
    ]);

    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_gerimai = new App\model\ModelGerimai($db, USER_DRINKS);
    $model_gerimai->insert(microtime(), $gerimas);
}

//$model_gerimai->insert('kokteilis', $kokteilis);
//$model_gerimai->insert('svyturio', $svyturio);
//$model_gerimai->insert('vodka', $vodka);
//$model_gerimai->insert('vanduo', $vanduo);
//$model_gerimai->deleteRows();

function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpeg', 'image/gif']) {
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

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$model_kokteiliai = new App\model\ModelGerimai($db, USER_DRINKS);
?>
<html>
    <head>
        <title>OOP</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <?php foreach ($model_kokteiliai->loadAll() as $kokteilis): ?>
            <div class="katalogas">
                <h2>Vardas: <?php print $kokteilis->getName(); ?></h2>
                <p>Abarotai: <?php print $kokteilis->getAbarot(); ?></p>
                <p>Kiekis: <?php print $kokteilis->getAmount(); ?></p>
                <img class="kokteilis-img" src="<?php print $kokteilis->getImage(); ?>"
            </div>
        <?php endforeach; ?>
        <?php require '../core/views/form.php'; ?>
        <h3><?php print $success_msg; ?></h3>
    </body>
</html>