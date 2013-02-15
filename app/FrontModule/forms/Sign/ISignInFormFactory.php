<?php
/**
 * ISignInFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\Blog
 *
 * @date    01.12.12
 */

namespace Flame\Blog\FrontModule\Forms\Sign;

interface ISignInFormFactory
{

	/**
	 * @return SignInForm
	 */
	public function create();
}
