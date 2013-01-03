owfs.php
========

Simple OWFS wrapper to access OWFS file system

Classes
========

OWFS
--------

OWFS is the main class to access the one wire file system.

It requires the owfs root path as paramter on creation.

Create an instance like this

```php
$owfs = new OWFS\OWFS('/owfs');
```

To loop all detected sensors use

```php
foreach ($owfs->getAll() as $sensor) {
  ...
}
```

To find a sensor by its property, just use the <code>getBy&lt;property>()</code> functions.

```php
$sensor = $owfs->getByAddress('284D38C203000041');
```

If more than one sensor matches (mostly by <code>getByType()</code>) an array of all matching sensors will be returned and FALSE for no match.

Sensor
--------

This the class to access the sensor properties, read and write.

You can access them with

```php
$temperature = $sensor->get('temperature');
$temperature = $sensor->temperature;
```

To get the uncached value, use

```php
$temperature = $sensor->get('temperature', TRUE);
$temperature = $sensor->temperature_uncached;
```

Get an array with all properties

```php
print_r($sensor->getAll());
```

will produce

<pre>
Array
(
    [address] => 284D38C203000041
    [alias] =>
    [crc8] => 41
    [family] => 28
    [fasttemp] => 25
    [id] => 4D38C2030000
    [locator] => FFFFFFFFFFFFFFFF
    [power] => 1
    [r_address] => 41000003C2384D28
    [r_id] => 000003C2384D
    [r_locator] => FFFFFFFFFFFFFFFF
    [temperature] => 24.9375
    [temperature10] => 25
    [temperature11] => 25
    [temperature12] => 24.9375
    [temperature9] => 25
    [temphigh] => 125
    [templow] => -55
    [type] => DS18B20
    [path] => /owfs/28.4D38C2030000
    [description] => Temperature
)
</pre>

<code>path</code> and <code>description</code> are not native owfs properties.

Family
--------

This class translates the <code>family</code> property into the description.

This class is used internally by accessing <code>$sensor->Description</code>
