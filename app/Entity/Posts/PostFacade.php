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

	/**
	 * @return array
	 */
	public function getLastPublic()
	{
		return $this->repository->findBy(array('public' => true), array('id' => 'DESC'));
	}

	/**
	 * @param Post $post
	 * @return mixed
	 */
	public function increaseViews(Post $post)
	{
		$post->setViews($post->getViews() + 1);
		return $this->save($post);
	}

}
