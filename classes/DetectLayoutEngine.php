<?php

class DetectLayoutEngine implements DetectInterface {
	private $name     = 'other';
	private $sname    = 'n/a';
	private $version  = 'n/a';

	private $config = array(
		'trident\/'        => 'trident',
		'(Apple)?WebKit\/' => 'applewebkit',
		'presto\/'         => 'presto',
		'gecko\/'          => 'gecko'
		);

	public function __construct($user_agent = '') {
		if (isset($this->config) && is_array($this->config)) {
			foreach($this->config as $match=>$name) {
				if (isset($match) && !empty($match) && DeviceDetection::match($user_agent,$match)) {
					$this->name = $name;
					break;
				}
			}
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

}