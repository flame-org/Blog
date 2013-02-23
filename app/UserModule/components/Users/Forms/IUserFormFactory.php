<?php
/**
 * IUserFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\UserModule\Components\Users\Forms;

interface IUserFormFactory
{

	/**
	 * @param array $defaults
	 * @return UserForm
	 */
	public function create(array $defaults);

}
