<?php
/**
 * ISignInFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package DoctrineSandbox
 *
 * @date    01.12.12
 */

namespace DoctrineSandbox\FrontModule\Forms\Sign;

interface ISignInFormFactory
{

	/**
	 * @return SignInForm
	 */
	public function create();
}
