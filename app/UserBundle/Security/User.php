<?php
/**
 * User.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\UserBundle\Security;

class User extends \Nette\Security\User
{

	/** @var \Nette\DI\Container */
	private $context;

	/** @var \Flame\Blog\UserBundle\Entity\Users\UserFacade */
	private $userFacade;

	/**
	 * @param \Flame\Blog\UserBundle\Entity\Users\UserFacade $userFacade
	 */
	public function injectUserFacade(\Flame\Blog\UserBundle\Entity\Users\UserFacade $userFacade)
	{
		$this->userFacade = $userFacade;
	}

	/**
	 * @param \Nette\Security\IUserStorage $storage
	 * @param \Nette\DI\Container $context
	 */
	public function __construct(\Nette\Security\IUserStorage $storage, \Nette\DI\Container $context)
	{
		parent::__construct($storage, $context);

		$this->context = $context;
	}

	/**
	 * @return \Flame\Blog\UserBundle\Entity\Users\User
	 */
	public function getModel()
	{
		return $this->userFacade->getOne($this->getId());
	}

}
