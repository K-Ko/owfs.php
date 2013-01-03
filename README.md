owfs.php
========

Simple OWFS wrapper to access [OWFS file system](http://owfs.org/)

Class OWFS\OWFS
--------

OWFS is the main class to access the one wire file system.

It requires the owfs root path as parameter on creation.

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

Class OWFS\Sensor
--------

This is the class to access the sensor properties, read and write.

You can read them with

```php
$temperature = $sensor->get('Temperature');
$temperature = $sensor->Temperature;
```

To get the uncached value, use

```php
$temperature = $sensor->get('Temperature', TRUE);
$temperature = $sensor->getUncached('Temperature');
$temperature = $sensor->Temperature_uncached;
```

Once readed property values (NOT uncached ones) are internaly cached, so file system is only queried once for each script run.

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

To write values, use

```php
$sensor->set('TempLow', -50);
$sensor->TempLow = -50;
```

Property names are case insensitive, in the file system all properties lowercase.

Class OWFS\Family
--------

This class translates the <code>family</code> code into the [description](http://owfs.org/index.php?page=family-code-list).

This class is used internally by accessing <code>$sensor->Description</code>
