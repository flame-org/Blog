<?php
/**
 * InFormFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Sharezone
 *
 * @date    01.09.12
 */

namespace DoctrineSandbox\FrontModule\Forms\Sign;

class SignInFormProcess extends \Nette\Object
{

	/**
	 * @var \Nette\Security\User $user
	 */
	private $user;

	/**
	 * @param \Nette\Security\User $user
	 */
	public function injectUser(\Nette\Security\User $user)
	{
		$this->user = $user;
	}

	/**
	 * @param SignInForm $form
	 */
	public function login(SignInForm $form)
	{
		$values = $form->getValues();

		try {

			if ($values->remember) {
				$this->user->setExpiration('+ 14 days', false);
			} else {
				$this->user->setExpiration('+ 2 hours', true);
			}

			$this->user->login($values->email, $values->password);

		} catch (\Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}

}
