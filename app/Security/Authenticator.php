<?php

namespace Flame\Blog\Security;

use Nette\Security as NS;


/**
 * Users authenticator.
 */
class Authenticator extends \Flame\Security\Authenticator
{
	/**
	 * @var \Flame\Blog\Entity\Users\UserFacade
	 */
	private $userFacade;

	/**
	 * @param \Flame\Blog\Entity\Users\UserFacade $userFacade
	 */
	public function __construct(\Flame\Blog\Entity\Users\UserFacade $userFacade)
	{
		$this->userFacade = $userFacade;
	}

	/**
	 * Performs an authentication
	 * @param  array
	 * @return \Nette\Security\Identity
	 * @throws \Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($email, $password) = $credentials;
		$user = $this->userFacade->getOneByEmail($email);

		if (!$user)
			throw new NS\AuthenticationException("User '$email' not found.", self::IDENTITY_NOT_FOUND);

		if (!$user->getPassword()->isEqual((string) $password))
			throw new NS\AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);

		$data = $user->toArray();
		unset($data['password'], $data['passwordSalt']);
		return new NS\Identity($user->getId(), null, $data);
	}

}
