<?php

class DetectBot implements DetectInterface {
	private $name     = 'n/a';
	private $sname    = 'n/a';
	private $version  = 'n/a';

	private $config = array(
		'google' => array(
			'googlebot',
			'adsbot-google',
			'mediapartners-google',
			'google web preview',
			'feedfetcher-google',
			'appengine-google'),
		'msn' => array(
			'msnbot',
			'msnbot-media',
			'MSIECrawler'),
		'bing' => array(
			'bingbot',
			'BingPreview'),
		'yahoo' => array(
			'slurp',
			'yahooseeker'),
		'alexa' => array(
			'ia_archiver'),
		'facebook' => array(
			'facebookexternalhit',
			'facebookplatform'),
		'other' => array(
			'crawler','spider','kenjin','cheesebot','cherrypicker','webzip','www-collector-e','k2spider','hloader','emailwolf','wget','webmasterworldforumbot',
			'bullseye','spankbot','jennybot','backdoorbot','erocrawler','linkscan','ubicrawler','npbot','openfind','webbandit','prowebwalker','repomonkey',
			'zealbot','sitesnagger','webstripper','webcopier','teleport','teleportpro','libwww','webreaper','emailcollector','copyrightcheck','webauto',
			'thumbnailagent','Genieo'),
	);

	public function __construct($user_agent = '') {
		if (isset($this->config) && is_array($this->config)) {
			foreach($this->config as $name=>$match) {
				foreach($match as $m) {
				  if (isset($m) && !empty($m) && DeviceDetection::match($user_agent,$m)) {
					  $this->name = $name;
					  break;
				  }
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