<?php
/**
 * SettingPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\BackModule;

class SettingPresenter extends BackPresenter
{

	/**
	 * @autowire
	 * @var \Flame\Blog\SettingModule\Components\Settings\ISettingControlFactory
	 */
	protected $settingControlFactory;

	/**
	 * @return \Flame\Blog\SettingModule\Components\Settings\SettingControl
	 */
	protected function createComponentSetting()
	{
		return $this->settingControlFactory->create();
	}

}
