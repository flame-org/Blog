<?php
/**
 * UserManager.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    16.02.13
 */

namespace Flame\Blog\UserModule\Model\Users;

class UserManager extends \Flame\Model\Manager
{

	/** @var \Flame\Blog\UserModule\Entity\Users\UserFacade */
	private $userFacade;

	/**
	 * @param \Flame\Blog\UserModule\Entity\Users\UserFacade $userFacade
	 */
	public function injectUserFacade(\Flame\Blog\UserModule\Entity\Users\UserFacade $userFacade)
	{
		$this->userFacade = $userFacade;
	}

	/**
	 * @param $data
	 * @return \Flame\Blog\UserModule\Entity\Users\User
	 * @throws \Nette\InvalidArgumentException
	 */
	public function update($data)
	{
		$data = $this->validateInput($data, array('email', 'newPassword', 'newPasswordConfirm'));

		if($data->newPassword != $data->newPasswordConfirm){
			throw new \Nette\InvalidArgumentException('Password mishmash');
		}else{
			/** @var $user \Flame\Blog\UserModule\Entity\Users\User */
			if($user = $this->userFacade->getOneByEmail($data->email)){
				$user->setPassword($this->createPassword($data->newPassword));
				$this->userFacade->save($user);
				return $user;
			}else{
				throw new \Nette\InvalidArgumentException('User ' . $data->oldEmail . ' does not exist');
			}
		}
	}

	/**
	 * @param $password
	 * @return \Flame\Types\Password
	 */
	protected function createPassword($password)
	{
		$passwordType = new \Flame\Types\Password();
		$passwordType->setPassword($password);
		return $passwordType;
	}

}
