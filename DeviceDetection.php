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
 - detect Browser 
 - detect Browser Version
 - detect Device Category (Desktop, Mobile, Tablet)
 */

class DeviceDetection {  
  private $detected = false;
  private $operating_system;
  private $layout_engine;
  private $browser;
  private $bot;
  private $is_bot = false;

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

    if (class_exists('DetectBot')) {
      $this->bot = new DetectBot($user_agent);
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

  public function getBot() {
    if ($this->bot instanceof DetectBot) {
      return $this->bot;
    }
  }

  public function isBot() {
    if ($this->bot instanceof DetectBot) {
      if ($this->bot->getName()=='n/a') {
         return false;
      }
      else {
        return true;
      }
    }
    else {
      return false;
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
