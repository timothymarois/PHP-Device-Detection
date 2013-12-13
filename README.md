PHP Device Detection
====================

PHP Device Detection (for Modern Platforms)
- detect mobile, tablet, and desktop devices
- detect Windows, Macintosh, Android, iOS and ChromeOS Operating Systems
- detect Chrome, Internet Explorer (5-11+), Safari, Opera, Amazon Silk, Yandex and Firefox Browsers
- detect Trident, WebKit, Presto, Gecko Layout Engines

This simple php library class supports the major and most popular platforms.

Also Supports the new Internet Explorer 11 (IE11) which no longer uses MSIE as its identifier.

Usage:
--------
```php
<?php
$DeviceDetection = new DeviceDetection();
$device = $DeviceDetection->detect();

// returns array of the following values
$device['UA'];
// Chrome, Internet Explorer 5.0-11.0, Apple Safari, Opera, Amazon Silk, Yandex, Mozilla Firefox
$device['BROWSER_NAME'];
// The version of the browser (returns a number without decimals)
$device['BROWSER_VER'];
// CH, IE, SF, OP, SK, YA, FF
$device['BROWSER_SHORT'];
// Windows, Macintosh, Android, iOS, ChromeOS
$device['DEVICE_OS'];
// Desktop, Tablet, Mobile
$device['DEVICE_CATEGORY']; 
// Trident, Webkit, Presto, Gecko
$device['LAYOUT_ENGINE'];

// OPTIONAL...
// if you wanted to run manual checks on a user agent, just add a new detect
$device2 = $DeviceDetection->detect($user_agent);
?>
```


Example
--------
```php
<?php

  if ($device['BROWSER_SHORT']=='IE')
  {
    // internet explorer only 
  }
  
?>
```

