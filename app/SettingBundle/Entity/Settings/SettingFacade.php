<?php
/**
 * SettingFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\SettingBundle\Entity\Settings;

class SettingFacade extends \Flame\Doctrine\Model\Facade
{

	/** @var string */
	protected $repositoryName = '\Flame\Blog\SettingBundle\Entity\Settings\Setting';

	/** @var array */
	private $settings = array();

	/**
	 * @param array $availableSettings
	 */
	public function setAvailableSetting(array $availableSettings = array())
	{
		$this->settings = $this->prepareAvaiableSetting($availableSettings);
	}

	/**
	 * @return array
	 */
	public function getAvailableSetting()
	{
		return $this->settings;
	}

	/**
	 * @param $name
	 * @return bool|int|string
	 */
	public function getAvailableSettingByName($name)
	{
		return \Flame\Utils\Arrays::recursiveSearch($name, $this->settings);
	}

	/**
	 * @param $name
	 * @return Setting
	 */
	public function getOneByName($name)
	{
		return $this->repository->findOneBy(array('name' => $name));
	}

	/**
	 * @return array
	 */
	public function getLast()
	{
		return $this->repository->findBy(array(), array('id' => 'DESC'));
	}

	/**
	 * @param $name
	 * @return string
	 */
	public function getSettingValue($name)
	{
		if($setting = $this->getOneByName($name)){
			return $setting->getValue();
		}
	}

	/**
	 * @param $availableSettings
	 * @return array
	 */
	private function prepareAvaiableSetting($availableSettings)
	{
		$settings = array();
		if(count($availableSettings)){
			foreach($availableSettings as $k => $v){
				switch($k){
					case 'text':
						$type = Setting::TEXT;
						break;
					case 'bool':
						$type = Setting::BOOL;
						break;
					default:
						$type = Setting::STRING;
						break;
				}
				$settings[$type] = $v;
			}
		}

		return $settings;
	}
}
