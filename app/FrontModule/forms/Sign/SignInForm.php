<?php
/**
 * InForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Sharezone
 *
 * @date    01.09.12
 */

namespace DoctrineSandbox\FrontModule\Forms\Sign;

class SignInForm extends \Flame\Application\UI\Form
{

	/**
	 * @var SignInFormProcess $singInFormProcess
	 */
	private $singInFormProcess;

	/**
	 * @param SignInFormProcess $singInFormProcess
	 */
	public function injectSingInFormProcess(SignInFormProcess $singInFormProcess)
	{
		$this->singInFormProcess = $singInFormProcess;
	}

	public function __construct()
	{
		parent::__construct();

		$this->configure();

		$this->onSuccess[] = $this->formSucceeded;
	}

	/**
	 * @param SignInForm $form
	 */
	public function formSucceeded(SignInForm $form)
	{
		$this->singInFormProcess->login($form);
	}

	private function configure()
	{
		$this->addText('email', 'Email:')
			->setRequired('Please provide a email.');

		$this->addPassword('password', 'Password:')
			->setRequired('Please provide a password.');

		$this->addCheckbox('remember', 'Remember me on this computer');

		$this->addSubmit('send', 'Sign in');
	}


}
