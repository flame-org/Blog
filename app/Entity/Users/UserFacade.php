<?php
/**
 * UserFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package DoctrineSandbox
 *
 * @date    20.08.12
 */

namespace DoctrineSandbox\Entity\Users;

class UserFacade extends \Flame\Model\Facade
{

	/**
	 * @var string
	 */
	protected $repositoryName = '\DoctrineSandbox\Entity\Users\User';

	/**
	 * @param $email
	 * @return object
	 */
	public function getOneByEmail($email)
	{
		return $this->repository->findOneBy(array('email' => $email));
	}
}
