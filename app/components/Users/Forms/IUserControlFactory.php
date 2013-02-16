<?php
/**
 * IUserControlFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Components\Users;

interface IUserControlFactory
{

	/**
	 * @return UserControl
	 */
	public function create();
}
