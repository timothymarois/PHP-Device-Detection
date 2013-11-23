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
$device['BROWSER_NAME'];
$device['BROWSER_VER'];
$device['BROWSER_SHORT'];
$device['DEVICE_OS'];
$device['DEVICE_CATEGORY'];
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

Todo: 
- Support for Bots (googlebot, bingbot, yahoobot, etc) 
- Support more browsers + OS


(I am using this application on thousands of users to see which popular user-agents are bypassing the detection) 
