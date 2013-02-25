<?php
/**
 * UserForm.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\UserBundle\Components\Users\Forms;

class UserForm extends \Flame\Blog\AppBundle\Application\UI\Form
{

	/** @var string */
	private $email;

	/** @var \Flame\Blog\UserBundle\Model\Users\UserManager */
	private $userManager;

	/**
	 * @param \Flame\Blog\UserBundle\Model\Users\UserManager $userManager
	 */
	public function injectUserManager(\Flame\Blog\UserBundle\Model\Users\UserManager $userManager)
	{
		$this->userManager = $userManager;
	}

	/**
	 * @param bool $asArray
	 * @return array|\Nette\ArrayHash
	 */
	public function getValues($asArray = false)
	{
		$values = (array) parent::getValues($asArray);
		$values['email'] = $this->email;
		return \Nette\ArrayHash::from($values);
	}

	/**
	 * @param array $default
	 */
	public function __construct(array $default)
	{
		parent::__construct();

		if(isset($default['email']))
			$this->email = $default['email'];

		$this->configure();
		$this->setDefaults($default);
		$this->onSuccess[] = $this->formSubmitted;
	}

	/**
	 * @param UserForm $form
	 */
	public function formSubmitted(UserForm $form)
	{
		try {
			$this->userManager->update($form->getValues());
			$this->presenter->flashMessage('Done', 'success');
		}catch (\Nette\InvalidArgumentException $ex) {
			$form->addError($ex->getMessage());
		}
	}

	private function configure()
	{
		$this->addText('email', 'Email')
			->setDisabled();

		$this->addPassword('newPassword', 'New password:')
		->setOption('description', 'Please enter at least 5 characters.')
			->addRule(self::MIN_LENGTH, null, 5)
			->addRule(self::FILLED);

		$this->addPassword('newPasswordConfirm', 'Confirm password:')
			->addRule(self::EQUAL, 'Entered passwords is not equal. Try it again.', $this['newPassword'])
			->addRule(self::FILLED);

		$this->addSubmit('send', 'Update password')
			->setAttribute('class', 'btn-primary');
	}

}
