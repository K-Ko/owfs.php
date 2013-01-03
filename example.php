<?php

// Root dir of owfs
$owfs_root = '/owfs';

// Example sensor type, here temperature sensors
$owfs_type = 'DS18B20';

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <style>
    pre { border: 1px solid gray; padding: 5px }
  </style>
  <title>Example page</title>
</head>
<body>
<?php

#ini_set('display_startup_errors', 1);
#ini_set('display_errors', 1);
#error_reporting(-1);

function __autoload($className) {
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    require $fileName;
}

$owfs = new OWFS\OWFS($owfs_root);

echo '<h2>All sensors</h2>';
echo '<pre>$sensors = $owfs->getAll();
print_r($sensors);

', print_r($owfs->getAll(), TRUE), '</pre>';

echo '<h2>All sensors of type "'.$owfs_type.'"</h2>';
echo '<pre>$sensors = $owfs->getByType(\''.$owfs_type.'\');
print_r($sensors);

', print_r($owfs->getByType($owfs_type), TRUE), '</pre>';

echo '<h2>All sensor properties</h2>';
echo '<pre>foreach($owfs->getAll() as $sensor) {
  print_r($sensor->getAll());
}

';
foreach($owfs->getAll() as $sensor) print_r($sensor->getAll());
echo '</pre>';
?>
</body>
</html>
