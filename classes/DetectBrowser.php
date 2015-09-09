<?php

class DetectBrowser implements DetectInterface {
	private $name     = 'other';
	private $sname    = 'oth';
	private $version  = '0';

	public function __construct($user_agent = '') {
    
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

}