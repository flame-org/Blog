<?php
/**
 * User.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Doctrine-sandbox
 *
 * @date    20.08.12
 */

namespace Flame\Blog\UserBundle\Entity\Users;

use Flame\Types\Password;

/**
 * @Entity
 */
class User extends \Flame\Doctrine\Entities\IdentifiedEntity
{

	/**
	 * @Column(type="string", length=128, unique=true)
	 */
	protected $email;

	/**
	 * @Column(type="string", length=128)
	 */
	protected $password;

	/**
	 * @Column(type="string", length=5)
	 */
	protected $passwordSalt;

	/**
	 * @param $email
	 * @param $password
	 */
	public function __construct($email, Password $password)
	{
		$this->email = $email;
		$this->password = (string) $password;
		$this->passwordSalt = $password->getSalt();
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = (string) $email;
		return $this;
	}

	public function getPassword()
	{
		return new Password($this->password, $this->passwordSalt);
	}

	public function setPassword(Password $password)
	{
		$this->password = (string) $password;
		$this->passwordSalt = $password->getSalt();
		return $this;
	}
}
