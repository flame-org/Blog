<?php
/**
 * SettingHelper.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Templating\Helpers;

class SettingHelper extends \Nette\Object
{

	/** @var \Flame\Blog\Entity\Settings\SettingFacade */
	private $settingFacade;

	/**
	 * @param \Flame\Blog\Entity\Settings\SettingFacade $settingFacade
	 */
	public function injectSettingFacade(\Flame\Blog\Entity\Settings\SettingFacade $settingFacade)
	{
		$this->settingFacade = $settingFacade;
	}

	/**
	 * @param $setting
	 * @return \Flame\Blog\Entity\Settings\Setting
	 */
	public function setting($setting)
	{
		return $this->settingFacade->getOneByName($setting);
	}

}
