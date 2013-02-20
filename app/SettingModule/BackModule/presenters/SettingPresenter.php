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
	 * @var \Flame\Blog\Components\Settings\ISettingControlFactory
	 */
	protected $settingControlFactory;

	/**
	 * @return \Flame\Blog\Components\Settings\SettingControl
	 */
	protected function createComponentSetting()
	{
		return $this->settingControlFactory->create();
	}

}
