<?php
/**
 *
 * Operating System Version References 
 * ==========================================
 * Windows OS
 * https://en.wikipedia.org/wiki/Windows_NT
 * Macintosh OS X
 * https://en.wikipedia.org/wiki/OS_X
 *
 */
class DetectOperatingSystem implements DetectInterface {
	private $name    = 'other';
	private $sname   = 'oth';
	private $version = '0';

	private $config = array(
		'windows'=>array(
			'match'=>'windows',
			'name'=>'windows',
			'short_name'=>'win',
			'versions'=>array(
				'NT 5.1' => 'xp',
				'NT 5.2' => 'xp',
				'NT 6.0' => 'vista',
				'NT 6.1' => '7',
				'NT 6.2' => '8',
				'NT 6.3' => '8.1',
				'NT 10.0'=> '10'
			)
		),

		'macintosh'=>array(
			'match'=>array('macintosh','mac os'),
			'name'=>'macintosh',
			'short_name'=>'mac',
			'versions'=>array(
				'10_0'  => 'cheetah',
				'10_1'  => 'puma',
				'10_2'  => 'jaguar',
				'10_3'  => 'panther',
				'10_4'  => 'tiger',
				'10_5'  => 'leopard',
				'10_6'  => 'snow leopard',
				'10_7'  => 'lion',
				'10_8'  => 'mountain lion',
				'10_9'  => 'mavericks',
				'10_10' => 'yosemite',
				'10_11' => 'el capitan'
			)
		),

		'chrome'=>array(
			'match'=>'cros',
			'name'=>'chromeos',
			'short_name'=>'chr',
			'versions'=>array(
			)
		),

		'android'=>array(
			'match'=>'android',
			'name'=>'android',
			'short_name'=>'and',
			'versions'=>array(
			)
		),

		'ios'=>array(
			'match'=>array('iphone;','ipad;'),
			'name'=>'ios',
			'short_name'=>'ios',
			'versions'=>array(
			)
		),

		'linux'=>array(
			'match'=>'linux',
			'name'=>'linux',
			'short_name'=>'lin',
			'versions'=>array(
			)
		)
	);

	public function __construct($user_agent = '') {
		foreach($this->config as $key=>$val) {
			if (isset($val['match']) && !empty($val['match']) && DeviceDetection::matchName($user_agent,$val['match'])) {
				$this->name  = $val['name'];
				$this->sname = $val['short_name'];
				if (isset($val['versions']) && !empty($val['versions']) && is_array($val['versions'])) {
					foreach($val['versions'] as $ver=>$name) {
						if (DeviceDetection::matchName($user_agent,$ver)) {
							$this->version = $name;
							break;
						}
					}
				}
				break;
			}
		}
  }

  public function getName() {
  	return $this->name;
  }

  public function getShortName() {
  	return $this->sname;
  }

  public function getVersion() {
  	return $this->version;
  }
}
