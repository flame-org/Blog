<?php
/**
 * UserFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\Blog
 *
 * @date    20.08.12
 */

namespace Flame\Blog\Entity\Users;

class UserFacade extends \Flame\Database\Repository\Model
{

	/**
	 * @var string
	 */
	protected $repositoryName = '\Flame\Blog\Entity\Users\User';

	/**
	 * @param $email
	 * @return object
	 */
	public function getOneByEmail($email)
	{
		return $this->findOneBy(array('email' => $email));
	}
}
