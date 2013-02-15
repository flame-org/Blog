<?php
/**
 * PostFacade.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @date    15.02.13
 */

namespace Flame\Blog\Entity\Posts;

class PostFacade extends \Flame\Doctrine\Model\Facade
{

	protected $repositoryName = '\Flame\Blog\Entity\Posts\Post';

	/**
	 * @return array
	 */
	public function getLast()
	{
		return $this->repository->findBy(array(), array('id' => 'DESC'));
	}

}
