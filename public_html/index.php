<?php
require_once '../bootloader.php';

$cookie = new \Core\Cookie('cookie_test');

if ($cookie->exists()) {
    $cookie_array = $cookie->read();
    $cookie_array[0]++;
    $cookie->save($cookie_array);
} else {
    $cookie->save([0]);
}
?>
<html>
    <head>
        <title>Sensors</title>
    </head>
    <body>
        <div>
            <?php if($cookie->exists()): ?>
            <?php print $cookie->read()[0]; ?>
            <?php endif; ?>
        </div>
    </body>
</html>