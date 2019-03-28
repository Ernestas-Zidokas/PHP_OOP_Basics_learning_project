<?php
require '../bootloader.php';
define('USER', 'input_users');

$form = [
    'fields' => [
        'username' => [
            'label' => 'Username',
            'type' => 'text',
            'placeholder' => 'Zirgas69',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'placeholder' => 'email@gmail.com',
            'validate' => [
                'validate_not_empty',
            ]
        ],
        'full_name' => [
            'label' => 'Full Name',
            'type' => 'text',
            'placeholder' => 'Ernestas Zidokas',
            'validate' => [
                'validate_not_empty'
            ]
        ],
        'age' => [
            'label' => 'Age',
            'placeholder' => '26',
            'type' => 'number',
            'validate' => [
                'validate_is_number'
            ]
        ],
        'gender' => [
            'label' => 'Gender',
            'type' => 'select',
            'placeholder' => '',
            'validate' => [
                'validate_not_empty'
            ],
            'options' => App\User::getGenderOptions()
        ],
        'orientation' => [
            'label' => 'Orientation',
            'type' => 'select',
            'placeholder' => '',
            'validate' => [
                'validate_not_empty'
            ],
            'options' => App\User::getOrientationOptions()
        ],
        'photo' => [
            'label' => 'Photo',
            'placeholder' => 'file',
            'type' => 'file',
            'validate' => [
                'validate_file'
            ]
        ],
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

function form_success($safe_input, $form) {
    $user = new \App\User([
        'username' => $safe_input['username'],
        'email' => $safe_input['email'],
        'full_name' => $safe_input['full_name'],
        'age' => $safe_input['age'],
        'gender' => $safe_input['gender'],
        'orientation' => $safe_input['orientation'],
        'photo' => $safe_input['photo']
    ]);

    $db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
    $model_user = new App\model\ModelUser($db, USER);
    $model_user->insert(microtime(), $user);
}

function validate_form_file(&$safe_input, &$form) {
    $file_saved_url = save_file($safe_input['photo']);
    if ($file_saved_url) {
        $safe_input['photo'] = 'uploads/' . $file_saved_url;
        return true;
    } else {
        $form['error_msg'] = 'Jobans/a tu buhurs/gazele nes failas supistas!';
    }
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
        $success_msg = strtr('User "@username" sėkmingai sukurtas!', [
            '@username' => $safe_input['username']
        ]);
    }
}

$db = new Core\FileDB(ROOT_DIR . '/app/files/db.txt');
$model_user = new App\Model\ModelUser($db, USER);
?>
<html>
    <head>
        <title>OOP</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <?php foreach ($model_user->loadAll() as $user): ?>
            <div class="katalogas">
                <h2>Username: <?php print $user->getUsername(); ?></h2>
                <p>Email: <?php print $user->getEmail(); ?></p>
                <p>Full Name: <?php print $user->getFullName(); ?></p>
                <p>Age: <?php print $user->getAge(); ?></p>
                <p>Gender: <?php print $user->getGender(); ?></p>
                <p>Orientation: <?php print $user->getOrientation(); ?></p>
                <img class="user-img" src="<?php print $user->getPhoto(); ?>">
            </div>
        <?php endforeach; ?>
        <?php require '../core/views/form.php'; ?>
        <?php if(isset($success_msg)): ?>
        <h3><?php print $success_msg; ?></h3>
        <?php endif; ?>
    </body>
</html>