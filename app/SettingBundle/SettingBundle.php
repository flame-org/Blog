<?php
/**
 * SettingModule.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    20.02.13
 */

namespace Flame\Blog\SettingBundle;

class SettingBundle extends \Flame\Bundles\BundleExtension
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();

		$this->registerTemplateHelper('setting', '@SettingHelper');
	}

}
