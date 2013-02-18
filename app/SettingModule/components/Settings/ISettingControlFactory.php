<?php
/**
 * ISettingControlFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Components\Settings;

interface ISettingControlFactory
{

	/**
	 * @param \Flame\Blog\Entity\Settings\Setting $setting
	 * @return SettingControl
	 */
	public function create(\Flame\Blog\Entity\Settings\Setting $setting = null);

}
