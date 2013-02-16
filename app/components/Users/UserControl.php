<?php
/**
 * UserControl.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\Components\Users;

class UserControl extends \Flame\Application\UI\Control
{

	/** @var \Flame\Blog\Security\User */
	private $user;

	/** @var \Flame\Blog\Components\Users\Forms\IUserFormFactory */
	private $userFormFactory;

	/**
	 * @param \Flame\Blog\Components\Users\Forms\IUserFormFactory $userFormFactory
	 */
	public function injectUserFormFactory(\Flame\Blog\Components\Users\Forms\IUserFormFactory $userFormFactory)
	{
		$this->userFormFactory = $userFormFactory;
	}

	/**
	 * @param \Flame\Blog\Security\User $user
	 */
	public function injectUser(\Flame\Blog\Security\User $user)
	{
		$this->user = $user;
	}

	/**
	 * @return Forms\UserForm
	 */
	protected function createComponentUserForm()
	{
		$defautl = array();
		if($user = $this->user->getModel() and $user instanceof \Flame\Blog\Entity\Users\User)
			$defautl = $user->toArray();

		$form = $this->userFormFactory->create($defautl);
		$form->onSuccess[] = $this->presenter->lazyLink('this');
		return $form;
	}
}
