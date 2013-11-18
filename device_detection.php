<?php
/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *
 * @author      Timothy Marois <timothymarois@gmail.com>
 *
 */

class device_detection {  

  protected $detected = false;

  protected $v = array(
    'UA'              => '',
    'BROWSER_NAME'    => 'Unknown',
    'BROWSER_VER'     => '0',
    'BROWSER_SHORT'   => 'UNK',
    'DEVICE_OS'       => 'Unknown',
    'DEVICE_CATEGORY' => 'Unknown',
    'LAYOUT_ENGINE'   => 'Unknown'
  );



  public function __construct() {

  }

  public function detect($ua="") {

    if ($ua!='') {
      $this->v['UA'] = $ua;
    }
    else {
      $this->v['UA'] = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
    }

    // detect major browsers

    // opera must be above chrome+safri (opera builds off chrome/safari)
    $this->detect_browser_opera();
    // chrome must be before safari (chrome builds off safari)
    $this->detect_browser_chrome();
    $this->detect_browser_firefox();
    $this->detect_browser_safari();
    $this->detect_browser_ie();

    // detect layout engine
    $this->detect_layout_engine();

    // detect operating systems
    $this->detect_os_platform();

    return $this->v;
  }

 

  protected function detect_layout_engine()
  {
    // http://en.wikipedia.org/wiki/List_of_layout_engines
    // todo: google 30+ and opera 15+ will use new engine "Blink"
    // we will ignore the version of the engine for now. possible on todo list?

    // http://en.wikipedia.org/wiki/Trident_(layout_engine)
    // widely microsoft usage
    if (preg_match("/(trident\/)/i", $this->v['UA'],$matches)) {
      $this->v['LAYOUT_ENGINE']  = 'Trident';
      return true;
    } 

    // webkit + applewebkit engine 
    if (preg_match("/(Apple)?WebKit\//i", $this->v['UA'],$matches)) {
      $this->v['LAYOUT_ENGINE']  = 'WebKit';
      return true;
    } 

    // opera from 7-15
    if (preg_match("/(presto\/)/i", $this->v['UA'],$matches)) {
      $this->v['LAYOUT_ENGINE']  = 'Presto';
      return true;
    } 

    // gecko is adapted on all major browsers as "like gecko" we want the firefox version 
    if (preg_match("/(gecko\/)/i", $this->v['UA'],$matches)) {
      $this->v['LAYOUT_ENGINE']  = 'Gecko';
      return true;
    } 
  }



  protected function detect_browser_chrome() {
    if ($this->detected==true) return false;

    if (preg_match("/(chrome)\/([0-9]+)/i", $this->v['UA'],$matches)) {
      $this->v['BROWSER_NAME']  = 'Chrome';
      $this->v['BROWSER_SHORT'] = 'CH';
      $this->v['BROWSER_VER']   = $matches[2];
      $this->detected = true;
      return true;
    } 
    else {
      // detect the iOS chrome version
      if (preg_match("/(CriOS)\/([0-9]+)/i", $this->v['UA'],$matches)) {
        $this->v['BROWSER_NAME']  = 'Chrome';
        $this->v['BROWSER_SHORT'] = 'CH';
        $this->v['BROWSER_VER']   = $matches[2];
        $this->detected = true;
        return true;
      }
    } 

    return false;
  }


  protected function detect_browser_firefox() {
    if ($this->detected==true) return false;

    if (preg_match("/(firefox)\/([0-9]+)/i", $this->v['UA'],$matches)) {
      $this->v['BROWSER_NAME']  = 'Firefox';
      $this->v['BROWSER_SHORT'] = 'FF';
      $this->v['BROWSER_VER']   = $matches[2];
      $this->detected = true;
      return true;
    } 

    return false;
  }


  protected function detect_browser_safari() {
    if ($this->detected==true) return false;

    if (preg_match("/(safari)\/([0-9]+)/i", $this->v['UA'],$matches)) {
      $this->v['BROWSER_NAME']  = 'Safari';
      $this->v['BROWSER_SHORT'] = 'SF';
      $this->v['BROWSER_VER']   = $matches[2];
      $this->detected = true;
      return true;
    } 

    return false;
  }


  protected function detect_browser_ie() {
    if ($this->detected==true) return false;

    // detects IE:6,7,8,9, and 10
    if (preg_match("/(msie) ([0-9]+)/i", $this->v['UA'],$matches)) {
      $this->v['BROWSER_NAME']  = 'Internet Explorer';
      $this->v['BROWSER_SHORT'] = 'IE';
      $this->v['BROWSER_VER']   = $matches[2];
      $this->detected = true;
      return true;
    } 
    else
    {
      // detection for IE11+ (removal of MSIE)
      // http://msdn.microsoft.com/en-us/library/ie/bg182625(v=vs.85).aspx
      if (preg_match("/trident/i",$this->v['UA']) && preg_match("/like gecko/i",$this->v['UA'])) {
        if (preg_match("/rv:([0-9]+)/i",$this->v['UA'],$matches)) {
          $this->v['BROWSER_NAME']  = 'Internet Explorer';
          $this->v['BROWSER_SHORT'] = 'IE';
          $this->v['BROWSER_VER']   = $matches[1];
          $this->detected = true;
          return true;
        }
      } 
    }

    return false;
  }


  protected function detect_browser_opera() {
    if ($this->detected==true) return false;

    // newest version of Opera
    if (preg_match("/(OPR)\/([0-9]+)/i", $this->v['UA'],$matches)) {
      $this->v['BROWSER_NAME']  = 'Opera';
      $this->v['BROWSER_SHORT'] = 'OP';
      $this->v['BROWSER_VER']   = $matches[2];
      $this->detected = true;
      return true;
    } 
    else {
      // detect older versions of opera
      if (preg_match("/presto\//i",$this->v['UA'])) {
        if (preg_match("/(opera)\/([0-9]+)/i", $this->v['UA'],$matches)) {
          $this->v['BROWSER_NAME']  = 'Opera';
          $this->v['BROWSER_SHORT'] = 'OP';
          $this->v['BROWSER_VER']   = $matches[2];
          $this->detected = true;
          return true;
        } 
      } 
    }

    return false;
  }



  protected function detect_os_platform() {
    if (preg_match("/(windows phone)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'Windows';
      $this->v['DEVICE_CATEGORY']   = 'Mobile';
      return true;
    } 

    if (preg_match("/(iemobile)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_CATEGORY']   = 'Mobile';
    } 

    if (preg_match("/(windows)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'Windows';
      $this->v['DEVICE_CATEGORY']   = 'Desktop';
      return true;
    } 

    if (preg_match("/(android [0-9])/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'Android';
      $this->v['DEVICE_CATEGORY']   = 'Mobile';
      return true;
    } 

    if (preg_match("/(iphone;)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'iOS';
      $this->v['DEVICE_CATEGORY']   = 'Mobile';
      return true;
    } 

    if (preg_match("/(ipad;)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'iOS';
      $this->v['DEVICE_CATEGORY']   = 'Tablet';
      return true;
    } 

    if (preg_match("/(macintosh;)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'Macintosh';
      $this->v['DEVICE_CATEGORY']   = 'Desktop';
      return true;
    } 

    if (preg_match("/(mac os)/i", $this->v['UA'],$matches)) {
      $this->v['DEVICE_OS']         = 'Macintosh';
      $this->v['DEVICE_CATEGORY']   = 'Desktop';
      return true;
    } 

    return false;
  }



}
