<?php

 include_once('DetectInterface.php');
 include_once('classes/DetectBot.php');
 include_once('classes/DetectBrowser.php');
 include_once('classes/DetectOperatingSystem.php');
 include_once('classes/DetectLayoutEngine.php');

 /**
  * DeviceDetection
  * @github github.com/timothymarois/PHP-Device-Detection
  * @author  Timothy Marois <timothymarois@gmail.com>
  *
  */

 /*


 GOALS : User Agent Detection System
 - detect Operating System
 - detect Operating System Version
 - detect Browser 
 - detect Browser Version
 - detect Device Category (Desktop, Mobile, Tablet)
 - detect Layout Engine
 - detect Bots 
 */

class DeviceDetection {  
  private $detected = false;
  private $operating_system;
  private $layout_engine;
  private $browser;

  public function __construct($user_agent = '') {

    if (class_exists('DetectBrowser')) {
      $this->browser = new DetectBrowser($user_agent);
    }

    if (class_exists('DetectOperatingSystem')) {
      $this->operating_system = new DetectOperatingSystem($user_agent);
    }

    if (class_exists('DetectOperatingSystem')) {
      $this->layout_engine = new DetectLayoutEngine($user_agent);
    }
  }

  public function __call($name,$args) {
      return 'n/a';
  }


  public function getBrowser() {
    if ($this->browser instanceof DetectBrowser) {
      return $this->browser;
    }
  }


  public function getOperatingSystem() {
    if ($this->operating_system instanceof DetectOperatingSystem) {
      return $this->operating_system;
    }
  }


  public function getLayoutEngine() {
    if ($this->layout_engine instanceof DetectLayoutEngine) {
      return $this->layout_engine;
    }
  }


  

  public static function match($user_agent,$match) {
    if (preg_match("/(".(is_array($match) ? implode('|',$match) : $match).")/i",$user_agent,$m)) {
      return true;
    }
    else {
      return false;
    }
  }

}
