<?php

class DetectOperatingSystem implements DetectInterface {

	private $name    = 'other';
	private $sname   = 'oth';
	private $version = '0';

	public function __construct($user_agent = '') {

		if ($this->matchName($user_agent,array('macintosh','mac os'))) {
			$this->name  = 'macintosh';
			$this->sname = 'mac';
		}

		if ($this->matchName($user_agent,'windows')) {
			$this->name  = 'windows';
			$this->sname = 'win';
		}

		if ($this->matchName($user_agent,'cros')) {
			$this->name  = 'Chrome';
			$this->sname = 'chr';
		}

		if ($this->matchName($user_agent,'android')) {
			$this->name  = 'android';
			$this->sname = 'and';
		}

		if ($this->matchName($user_agent,array('iphone;','ipad;'))) {
			$this->name  = 'ios';
			$this->sname = 'ios';
		}

		if ($this->matchName($user_agent,'linux')) {
			$this->name  = 'linux';
			$this->sname = 'lin';
		}
  }

  public function getName() {
  	return $this->name;
  }

  public function getVersion() {
  	return $this->version;
  }

  public function getShortName() {
  	return $this->sname;
  }

  private function matchName($user_agent,$match) {
  	if (preg_match("/(".(is_array($match) ? implode('|',$match) : $match).")/i",$user_agent,$m)) {
  		return true;
  	}
  	else {
  		return false;
  	}
  }

}