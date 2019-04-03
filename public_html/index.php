<?php
require_once '../bootloader.php';

$sensors = new \App\Sensors();
$fart_sensor = new App\SensorFartTemp;
$humidity_sensor = new App\SensorFartHumidity;
$sensors->add('Temp Sensor', $fart_sensor);
$sensors->add('Humidity Sensor', $humidity_sensor);
?>
<html>
    <head>
        <title>Sensors</title>
    </head>
    <body>
        <div>
            <?php foreach ($sensors->getReadings() as $id => $reading): ?>
                <p><?php print $id . ': ' . $reading; ?></p>
            <?php endforeach; ?>
        </div>
    </body>
</html>