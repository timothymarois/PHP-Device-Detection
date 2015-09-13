PHP Device Detection
====================

PHP Device Detection (for Modern Platforms)
- detect Windows, Macintosh, Android, iOS, Linux and ChromeOS Operating Systems
- detect Chrome, Internet Explorer (5-11+), Safari, Opera, Amazon Silk, Yandex, Firefox Browsers and Support for Microsoft Edge.
- detect Trident, WebKit, Presto, Gecko Layout Engines

This simple php library class supports the major and most popular platforms.

* Supports the Internet Explorer 11 (IE11) which no longer uses MSIE as its identifier.
* Supports Microsoft Edge Browser (in windows 10)

API:
--------
```php
// Browser: 
getBrowser()->getName();
getBrowser()->getShortName();
getBrowser()->getVersion();

// Operating System :
getOperatingSystem()->getName();
getOperatingSystem()->getShortName();
getOperatingSystem()->getVersion();

// Layout Engine:
getLayoutEngine()->getName();

// Bot Detection ("n/a" if bot is not found)
getBot()->getName();
// check if the user is a bot returns (boolean true or false)
isBot();

```

Example
--------
```php
<?php

  // include the device detection class
  include('/PHP-Device-Detection/DeviceDetection.php');

  // user agent for example
  $user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36';

  // start up the detection
  $mydetection = new DeviceDetection($user_agent);

  echo 'Browser: '.$mydetection->getBrowser()->getName();
  echo '<br>';
  echo 'OperatingSystemName: '.$mydetection->getOperatingSystem()->getName();
  echo '<br>';
  echo 'OperatingSystemVersion: '.$mydetection->getOperatingSystem()->getVersion();
  echo '<br>';
  echo 'Layout Engine: '.$mydetection->getLayoutEngine()->getName();
  echo '<br>';
  echo 'Bot Detected: '.$mydetection->getBot()->getName();
  echo '<br>';
  echo 'Are you a bot?  '.(($mydetection->isBot()===true) ? 'yes' : 'no');
  echo '<br>'; 

  if ($mydetection->getBrowser()->getShortName()=='ie')
  {
    // internet explorer only 
  }


  if ($mydetection->getOperatingSystem()->getName()=='windows')
  {
    // only windows operating system can see this
  }




  
?>
```

