<?php
/**
 * User.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Doctrine-sandbox
 *
 * @date    20.08.12
 */

namespace Flame\Blog\Entity\Users;

class User extends \Flame\Doctrine\Entity
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
	 * @Column(type="string", length=255)
	 */
	protected $name;

	/**
	 * @param $email
	 * @param $password
	 */
	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
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
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = (string) $password;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = (string) $name;
		return $this;
	}
}
