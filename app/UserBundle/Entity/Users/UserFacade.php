<?php
/**
 * UserFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\Blog
 *
 * @date    20.08.12
 */

namespace Flame\Blog\UserBundle\Entity\Users;

class UserFacade extends \Flame\Doctrine\Model\Facade
{

	/**
	 * @var string
	 */
	protected $repositoryName = '\Flame\Blog\UserBundle\Entity\Users\User';

	/**
	 * @param $email
	 * @return object
	 */
	public function getOneByEmail($email)
	{
		return $this->repository->findOneBy(array('email' => $email));
	}
}
