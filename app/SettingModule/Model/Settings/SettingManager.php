<?php
/**
 * SettingManager.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\SettingModule\Model\Settings;

use Flame\Blog\SettingModule\Entity\Settings\Setting;

class SettingManager extends \Flame\Model\Manager
{

	/** @var \Flame\Blog\SettingModule\Entity\Settings\SettingFacade */
	private $settingFacade;

	/**
	 * @param \Flame\Blog\SettingModule\Entity\Settings\SettingFacade $settingFacade
	 */
	public function injectSettingFacade(\Flame\Blog\SettingModule\Entity\Settings\SettingFacade $settingFacade)
	{
		$this->settingFacade = $settingFacade;
	}

	/**
	 * @param $data
	 * @return bool
	 */
	public function update($data)
	{
		if(count($data)){
			foreach($data as $name => $value){
				if($setting = $this->settingFacade->getOneByName($name)){
					$setting->setValue($value);
					$this->settingFacade->save($setting);

				}else{
					if($type = $this->settingFacade->getAvailableSettingByName($name)){
						$setting = $this->createSetting($name, $value, $type);
						$this->settingFacade->save($setting);
					}
				}
			}

			return true;
		}else{
			return false;
		}
	}

	/**
	 * @param $name
	 * @param $value
	 * @param int $type
	 * @return \Flame\Blog\SettingModule\Entity\Settings\Setting
	 */
	protected function createSetting($name, $value, $type = Setting::STRING)
	{
		$setting = new Setting($name, $value);
		$setting->setType($type);
		return $setting;
	}

}
