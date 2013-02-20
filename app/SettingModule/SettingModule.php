<?php
/**
 * SettingModule.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    20.02.13
 */

namespace Flame\Blog\SettingModule;

class SettingModule extends \Flame\Config\Extensions\ModuleExtension
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();

		$this->registerTemplateHelper('setting', '@SettingHelper');
	}

}
