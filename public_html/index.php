<?php
require_once '../bootloader.php';

$sensors = new \App\Sensors();
$sensor_fart_temp = new App\SensorFartTemp();
$sensor_fart_humidity = new App\SensorFartHumidity();
$sensors->add('Temp Sensor', $sensor_fart_temp);
$sensors->add('Humidity Sensor', $sensor_fart_humidity);
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